<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="container">
        <!-- Breadcrumb Navigation -->
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pesan</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center">Pesan</h3>
                <hr>
                <table class="table table-sm table-striped table-borderless table-hover" id="TabelData1">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th class="text-center align-middle">IP Address</th>
                            <!-- <th class="text-center align-middle">Device ID</th> -->
                            <th class="text-center align-middle">Lokasi</th>
                            <th class="text-center align-middle">Status</th>
                            <th class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php foreach ($messagesByIp as $ip => $messages): ?>
                            <tr>
                                <td class="text-center">
                                    <?= $ip ?>
                                </td>
                                <!-- <td class="text-center">
                                    <?php
                                    // Menampilkan Device ID dari pesan pertama
                                    $device_id = isset($messages[0]['device_id']) ? $messages[0]['device_id'] : 'Device ID Tidak Tersedia';
                                    echo $device_id;
                                    ?>
                                </td> -->
                                <td class="text-center">
                                    <?php
                                    // Menampilkan lokasi dari pesan pertama (biasanya lokasi pertama relevan untuk semua pesan dengan IP yang sama)
                                    $location = isset($messages[0]['location']) ? $messages[0]['location'] : 'Lokasi Tidak Diketahui';
                                    echo $location;
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($messages[0]['is_read'] == 1): ?>
                                        <span class="text-primary">Dibaca</span>
                                    <?php else: ?>
                                        <span class="text-danger">Belum Dibaca</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#chatModal" onclick="openChat('<?= $ip ?>', '<?= $device_id ?>')"><i class="fas fa-search"></i> Lihat Pesan</button>
                                    <!-- <button class="btn btn-outline-secondary btn-sm" onclick="markAllAsRead('<?= $ip ?>')"><i class="fas fa-check-double"></i> Baca Semua</button> -->
                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteMessagesAndImagesByIp('<?= $ip ?>')"><i class="fas fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel" aria-hidden="true">
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
                                <button type="button" class="btn btn-block btn-outline-primary" onclick="sendMessage()">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Inisialisasi variabel global
    let lastTimestamp = Math.floor(Date.now() / 1000); // Timestamp saat ini (UNIX time)
    let isTabActive = true;
    let lastMessageId = 0;
    let currentIp = '';
    let currentDeviceId = '';
    let pollingInterval;
    let isFirstLoad = true;

    // Objek suara notifikasi
    const audio = new Audio('assets/sounds/notification.mp3');

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
                    window.focus();
                    window.location.href = '<?= base_url("admin/pesan") ?>';
                };
            });
        }
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
        if (!currentDeviceId) {
            alert("Device ID tidak ditemukan. Silakan pilih pengguna untuk dibalas.");
            return;
        }
        const messageInput = document.getElementById('message-input');
        const message = messageInput.value.trim();
        const sendButton = document.querySelector('.btn');
        if (message === "") {
            alert("Pesan tidak boleh kosong.");
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
                        const messageElement = document.createElement('div');
                        const isAdmin = msg.user_type === 'admin';
                        messageElement.classList.add(isAdmin ? 'admin-message' : 'user-message');
                        const avatarUrl = isAdmin ? '<?= base_url("assets/img/admin-avatar.png"); ?>' : '<?= base_url("assets/img/user-avatar.png"); ?>';
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
                        messageContent = isAdmin ? `${messageContent}<img src="${avatarUrl}" alt="Admin Avatar" class="chat-avatar">` : `<img src="${avatarUrl}" alt="User Avatar" class="chat-avatar">${messageContent}`;
                        messageElement.innerHTML = messageContent;
                        chatContainer.appendChild(messageElement);
                        if (!isAdmin) audio.play();
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
    function deleteMessagesAndImagesByIp(ip) {
        if (confirm("Apakah Anda yakin ingin menghapus semua pesan dan gambar untuk IP ini?")) {
            $.ajax({
                url: '<?= site_url("admin/pesan/delete_messages_and_images_by_ip") ?>',
                type: 'POST',
                data: {
                    ip: ip
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Pesan dan gambar berhasil dihapus.');
                        location.reload();
                    } else {
                        alert('Gagal menghapus pesan dan gambar.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menghapus pesan dan gambar.');
                }
            });
        }
    }

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