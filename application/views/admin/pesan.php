<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <!-- <hr>
                <h3 class="text-center">Kepala Dinas <br> Dari Masa Ke Masa</h3>
                <hr> -->
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $title; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Last Chat</th>
                                    <th class="text-center align-middle">IP Address</th>
                                    <th class="text-center align-middle">Device ID</th>
                                    <th class="text-center align-middle">Lokasi</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($messagesByIp as $messages): ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++ ?></td>
                                        <td class="text-center align-middle"><?= date('d M Y H:i:s', strtotime($messages['last_chat'])) ?></td>
                                        <td class="text-center align-middle"><?= $messages['ip_address'] ?></td>
                                        <td class="text-center align-middle"><?= $messages['device_id'] ?></td>
                                        <td class="text-center align-middle"><?= $messages['location'] ?? 'Lokasi Tidak Diketahui' ?></td>
                                        <td class="text-center align-middle">
                                            <?php if ($messages['unread_count'] > 0): ?>
                                                <span class="text-danger">Belum Dibaca (<?= $messages['unread_count'] ?>)</span>
                                            <?php else: ?>
                                                <span class="text-primary">Dibaca</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-outline-primary btn-sm mt-1 mb-1" data-toggle="modal" data-target="#chatModal" onclick="openChat('<?= $messages['ip_address'] ?>', '<?= $messages['device_id'] ?>')">
                                                <i class="fas fa-search"></i> Lihat Pesan
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm mt-1 mb-1" data-toggle="modal" data-target="#modalHapus" data-ip="<?= $messages['ip_address'] ?>" data-device="<?= $messages['device_id'] ?>">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                            <!-- <button class="btn btn-outline-secondary btn-sm" onclick="markAllAsRead('<?= $ip ?>')"><i class="fas fa-check-double"></i> Baca Semua</button> -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="modal fade" id="chatModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="chatModalLabel">Chat with User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeChat()">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="chat-body" style="overflow-y: auto; max-height: 350px;">
                                        <!-- Pesan akan dimuat di sini -->
                                    </div>
                                    <div class="modal-footer">
                                        <textarea id="message-input" placeholder="Tulis balasan..." class="form-control"></textarea>
                                        <button type="button" class="btn btn-block btn-outline-danger" onclick="sendMessage()">Balas Pesan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalHapus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus pesan dan gambar untuk perangkat ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-outline-danger" id="confirmHapus">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    // Inisialisasi variabel global
    let lastTimestamp = Math.floor(Date.now() / 1000); // Timestamp saat ini (UNIX time)
    let isTabActive = true;
    let lastMessageId = 0;
    let currentIp = '';
    let currentDeviceId = '';
    let pollingInterval;
    let isFirstLoad = true;
    let isSending = false;

    // Objek suara notifikasi
    const audio = new Audio('../assets/sounds/notification.mp3');

    // Monitor apakah tab aktif atau tidak
    document.addEventListener("visibilitychange", () => {
        isTabActive = !document.hidden;
    });

    // Fungsi untuk memeriksa pesan baru
    function checkNewMessages() {
        $.ajax({
            url: '<?= base_url("admin/pesan/load_table_data") ?>',
            method: 'GET',
            data: {
                timestamp: lastTimestamp
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.newMessages) {
                    lastTimestamp = data.latestTimestamp;
                    if (!isTabActive) {
                        // Jika tab tidak aktif, putar suara notifikasi dan tampilkan web notification
                        audio.play();
                        showWebNotification(data.messages);
                    }
                }
            }
        });
    }

    // Fungsi untuk menampilkan Web Notification
    function showWebNotification(messages) {
        if (Notification.permission === "granted") {
            messages.forEach(message => {
                const notification = new Notification("Pesan Baru dari User", {
                    body: message.message,
                    icon: 'assets/img/user-avatar.png'
                });
                notification.onclick = function() {
                    // Saat klik notifikasi, anggap pesan sudah dibaca dan hentikan suara
                    markMessageAsRead(message.id);
                    window.focus();
                    window.location.href = '<?= base_url("admin/pesan") ?>';
                };
            });
        }
    }

    // Fungsi untuk menandai pesan sebagai sudah dibaca
    function markMessageAsRead(messageId) {
        $.ajax({
            url: '<?= base_url("admin/pesan/mark_as_read") ?>',
            method: 'POST',
            data: {
                message_id: messageId
            },
            success: function(response) {
                // Jika berhasil menandai sebagai dibaca, tidak perlu memutar suara lagi
                console.log('Pesan berhasil ditandai sebagai dibaca');
            }
        });
    }

    // Meminta izin untuk notifikasi jika belum diberikan
    if (Notification.permission !== "granted") {
        Notification.requestPermission();
    }

    // Fungsi untuk membuka obrolan
    function openChat(ip, deviceId) {
        currentIp = ip;
        currentDeviceId = deviceId;
        document.getElementById('chat-body').innerHTML = '';
        lastMessageId = 0;
        isFirstLoad = true;
        loadNewMessages(ip, deviceId);
        startPolling();
    }

    // Fungsi untuk menutup obrolan
    function closeChat() {
        stopPolling();
    }

    // Fungsi untuk mengirim pesan
    function sendMessage() {
        if (isSending) return; // abaikan jika sedang mengirim
        isSending = true;

        if (!currentDeviceId) {
            alert("Device ID tidak ditemukan. Silakan pilih pengguna untuk dibalas.");
            isSending = false;
            return;
        }
        const messageInput = document.getElementById('message-input');
        const message = messageInput.value.trim();
        const sendButton = document.querySelector('.btn');
        if (message === "") {
            alert("Pesan tidak boleh kosong.");
            isSending = false;
            return;
        }
        sendButton.disabled = true;

        const formData = new FormData();
        formData.append('message_id', lastMessageId);
        formData.append('reply_message', message);
        formData.append('device_id', currentDeviceId);
        formData.append('ip', currentIp);

        fetch('<?= site_url('admin/pesan/reply_message'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    messageInput.value = '';
                    loadNewMessages(currentIp, currentDeviceId);
                } else {
                    alert(data.message || "Gagal mengirim balasan.");
                }
            })
            .catch(() => {
                alert("Terjadi kesalahan saat mengirim balasan.");
            })
            .finally(() => {
                sendButton.disabled = false;
                isSending = false;
            });
    }

    // Fungsi untuk memuat pesan baru
    function loadNewMessages(ip, deviceId, chatContainerId = 'chat-body') {
        fetch(`<?= base_url('admin/pesan/load_messages?ip=') ?>${ip}&device_id=${deviceId}&last_id=${lastMessageId}`)
            .then(response => response.json())
            .then(result => {
                if (result.status === 'success' && result.messages.length > 0) {
                    const chatContainer = document.getElementById(chatContainerId);
                    if (!chatContainer) return;

                    const initialScrollHeight = chatContainer.scrollHeight;
                    result.messages.sort((a, b) => a.id - b.id);

                    result.messages.forEach(msg => {
                        const isAdmin = msg.user_type === 'admin';

                        // Buat elemen pesan
                        const messageElement = document.createElement('div');
                        messageElement.classList.add(isAdmin ? 'admin-message' : 'user-message'); // Sesuaikan kelas berdasarkan pengirim

                        const avatarUrl = isAdmin ?
                            '<?= base_url("assets/img/admin-avatar.png"); ?>' :
                            '<?= base_url("assets/img/user-avatar.png"); ?>';
                        let messageContent = `<div class="message-text">${msg.message}`;

                        if (msg.image_url) {
                            const imageUrl = msg.image_url;
                            messageContent += `<div class="message-image"><img src="${imageUrl}" alt="Sent Image" style="max-width: 100px;"></div>`;
                        }

                        const formattedDate = new Date(msg.created_at).toLocaleString('id-ID', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        messageContent += `<div class="message-date">${formattedDate}</div></div>`;
                        messageContent = isAdmin ?
                            `${messageContent}<img src="${avatarUrl}" alt="Admin Avatar" class="chat-avatar">` :
                            `<img src="${avatarUrl}" alt="User Avatar" class="chat-avatar">${messageContent}`;
                        messageElement.innerHTML = messageContent;
                        chatContainer.appendChild(messageElement);

                        // Putar suara hanya untuk pesan user yang belum dibaca
                        if (!isAdmin && !msg.is_read && !msg.is_admin) {
                            audio.play(); // Putar suara hanya untuk pesan user
                        }
                    });

                    if (result.messages.length > 0) {
                        lastMessageId = result.messages[result.messages.length - 1].id;
                        const newScrollHeight = chatContainer.scrollHeight;
                        if (newScrollHeight > initialScrollHeight) {
                            chatContainer.scrollTop = newScrollHeight;
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error loading messages:', error);
            });
    }

    // Fungsi untuk memulai polling
    function startPolling() {
        pollingInterval = setInterval(() => {
            loadNewMessages(currentIp, currentDeviceId);
        }, 5000);
    }

    // Fungsi untuk menghentikan polling
    function stopPolling() {
        clearInterval(pollingInterval);
    }

    // Fungsi untuk menghapus pesan dan gambar berdasarkan IP
    // Menangkap data dari tombol dan memasukkannya ke dalam modal
    $('#modalHapus').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget); // Tombol yang men-trigger modal
        const ip = button.data('ip'); // Ambil data IP
        const device_id = button.data('device'); // Ambil data Device ID

        // Simpan data ke tombol konfirmasi
        const confirmButton = $(this).find('#confirmHapus');
        confirmButton.data('ip', ip);
        confirmButton.data('device', device_id);
    });

    // Eksekusi penghapusan saat tombol "Hapus" di dalam modal diklik
    $('#confirmHapus').on('click', function() {
        const ip = $(this).data('ip');
        const device_id = $(this).data('device');

        // Tutup modal setelah tombol Hapus diklik
        $('#modalHapus').modal('hide');

        // Lakukan penghapusan dengan AJAX
        $.ajax({
            url: '<?= site_url("admin/pesan/delete_messages_and_images_by_ip_and_device") ?>',
            type: 'POST',
            data: {
                ip: ip,
                device_id: device_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Tampilkan notifikasi SweetAlert untuk pesan berhasil
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Pesan dan gambar berhasil dihapus.',
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    }).then(() => {
                        location.reload(); // Refresh halaman setelah notifikasi
                    });
                } else {
                    // Tampilkan notifikasi SweetAlert untuk pesan gagal
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Pesan dan gambar gagal dihapus.',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                }
            },
            error: function() {
                // Tampilkan notifikasi SweetAlert untuk pesan error
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    title: 'Terjadi kesalahan saat menghapus pesan dan gambar.',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            }
        });
    });

    // Mulai polling pesan baru setiap 5 detik
    setInterval(checkNewMessages, 5000);
</script>

<!-- <script>
    function markAllAsRead(ip) {
        $.ajax({
            url: '<?= site_url("admin/pesan/mark_all_as_read") ?>',
            type: 'POST',
            data: {
                ip: ip
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Berhasil membaca semua pesan untuk IP ini.');
                    location.reload();
                } else {
                    alert('Terjadi kesalahan saat menandai pesan sebagai telah dibaca.');
                }
            },
            error: function() {
                alert('Ada masalah dengan permintaan tersebut.');
            }
        });
    }
</script> -->