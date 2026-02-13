<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/png">
    @include('component.v_importcss')
    @vite('resources/css/app.css')
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>

<body>
    <div class="w-full min-h-screen flex" id="layoutContainer">
        <div class="fixed left-0 top-0 h-screen z-40 transition-all duration-300" id="sidebarContainer">
            @include('component.sidebar')
        </div>

        <div class="flex-1 flex flex-col h-screen transition-all duration-300 ml-0 md:ml-64" id="mainContent">
            <div class="fixed top-0 right-0 z-30 bg-gray-100 transition-all duration-300 left-0 md:left-[16.5rem] h-[3rem]"
                id="headerContainer">
                @include('component.header')
            </div>
            <main class="flex-1 overflow-y-auto p-4 mt-[4rem] scrollbar" id="contentArea">
                <?= $content ?>
            </main>
        </div>
    </div>
    <div id="global-confirm-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 backdrop-blur-sm transition-opacity">

        <div class="relative p-4 w-full max-w-sm modal-content-animate">

            <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">

                <button type="button"
                    class="absolute top-4 right-4 text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-full text-sm w-8 h-8 flex items-center justify-center transition-all"
                    data-modal-hide="global-confirm-modal">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <div class="p-6 text-center">
                    <div
                        class="mx-auto mb-5 w-16 h-16 flex items-center justify-center rounded-full bg-yellow-50 text-yellow-500 animate-pulse-slow">
                        <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>

                    <h3 id="confirmTitle" class="mb-2 text-xl font-bold text-gray-800">
                        Konfirmasi
                    </h3>
                    <p id="confirmMessage" class="mb-6 text-sm text-gray-500 leading-relaxed">
                        Apakah Anda yakin ingin melakukan tindakan ini? Tindakan ini mungkin tidak dapat dibatalkan.
                    </p>

                    <div class="flex justify-center gap-3">
                        <button data-modal-hide="global-confirm-modal" type="button"
                            class="py-2.5 px-5 text-sm font-medium text-gray-600 bg-white rounded-xl border border-gray-200 hover:bg-gray-50 hover:text-gray-900 hover:border-gray-300 focus:z-10 focus:ring-2 focus:ring-gray-100 transition-all">
                            Batalkan
                        </button>

                        <button id="confirmAction" type="button"
                            class="py-2.5 px-6 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl shadow-lg shadow-red-500/30 focus:ring-4 focus:outline-none focus:ring-red-300 transition-all flex items-center gap-2 transform active:scale-95">
                            Lanjutkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('component.v_importjs')
    <script>
        $(document).ready(function() {
            const modal = $('#transactionModal');
            const modalTitle = $('#modalTransTitle');
            const modalDesc = $('#modalTransDesc');
            const inputAmount = $('#transAmount');
            const btnSubmit = $('#btnSubmitTrans');
            const form = $('#formTransaction');

            let transactionType = 'topup';

            const ctx = $('#lineChart');
            if (ctx.length) {
                const config = {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                        datasets: [{
                            data: [65, 59, 80, 81, 56, 55, 40],
                            fill: true,
                            borderColor: '#2E973E',
                            backgroundColor: 'rgba(46, 151, 62, 0.1)',
                            tension: 0.4,
                            borderWidth: 2,
                            pointRadius: 0,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                display: true,
                                grid: {
                                    display: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 10
                                    }
                                }
                            }
                        }
                    }
                };
                new Chart(ctx, config);
            }

            function openModal(type) {
                transactionType = type;
                $('#errorMsg').addClass('hidden');
                inputAmount.val('');
                inputAmount.removeClass('border-red-500');

                if (type === 'topup') {
                    modalTitle.text('Top Up Saldo');
                    modalDesc.text('Silakan masukkan nominal top up Anda');
                    btnSubmit
                        .removeClass('bg-red-500 hover:bg-red-600 shadow-red-500/30')
                        .addClass('bg-[#2E973E] hover:bg-[#1b5e20] shadow-green-500/30');
                } else {
                    modalTitle.text('Tarik Saldo');
                    modalDesc.text('Masukkan jumlah yang ingin ditarik ke rekening');
                    btnSubmit
                        .removeClass('bg-[#2E973E] hover:bg-[#1b5e20] shadow-green-500/30')
                        .addClass('bg-red-500 hover:bg-red-600 shadow-red-500/30');
                }

                modal.removeClass('hidden').fadeIn(200);
                inputAmount.focus();
            }

            $('#btnTopupOpen').on('click', function() {
                openModal('topup');
            });
            $('#btnWithdrawOpen').on('click', function() {
                openModal('withdraw');
            });

            $('.close-modal').on('click', function() {
                modal.fadeOut(200, function() {
                    modal.addClass('hidden');
                });
            });

            $('.quick-amount').on('click', function() {
                inputAmount.val($(this).data('value'));
            });

            function setLoading(isLoading) {
                if (isLoading) {
                    btnSubmit.prop('disabled', true).addClass('opacity-70 cursor-not-allowed');
                    btnSubmit.html(
                        '<i class="fa fa-circle-notch fa-spin text-lg"></i><span class="ml-2">Memproses...</span>'
                    );
                    inputAmount.prop('disabled', true);
                } else {
                    btnSubmit.prop('disabled', false).removeClass('opacity-70 cursor-not-allowed');
                    btnSubmit.html('<span>Lanjutkan</span><i class="fa-solid fa-arrow-right ml-2"></i>');
                    inputAmount.prop('disabled', false);
                }
            }

            form.on('submit', function(e) {
                e.preventDefault();
                const amount = parseFloat(inputAmount.val());

                if (isNaN(amount) || amount <= 0) {
                    $('#errorMsg').removeClass('hidden').text('Masukkan jumlah yang valid');
                    inputAmount.addClass('border-red-500');
                    return;
                }

                setLoading(true);

                if (transactionType === 'topup') {
                    $.ajax({
                        url: '{{ route('user_topup') }}',
                        method: 'POST',
                        data: {
                            amount: amount,
                            usernm: '{{ $user->usernm ?? 'User' }}',
                            email: '{{ $user->email ?? 'user@mail.com' }}',
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(res) {
                            setLoading(false);

                            if (!res || !res.snap_token) {
                                notyf.error(res?.msg || 'Gagal mendapatkan token pembayaran');
                                return;
                            }

                            $('.close-modal').click();

                            if (typeof window.snap !== 'undefined') {
                                window.snap.pay(res.snap_token, {
                                    onSuccess: function(result) {
                                        handleTopupSuccess(res, result);
                                    },
                                    onPending: function(result) {
                                        handleTopupSuccess(res, result);
                                        notyf.success(
                                            'Pembayaran tercatat, menunggu konfirmasi'
                                        );
                                    },
                                    onError: function() {
                                        notyf.error('Pembayaran gagal');
                                    }
                                });

                            } else {
                                notyf.error('Midtrans Snap belum siap.');
                            }
                        },
                        error: function(xhr) {
                            setLoading(false);
                            notyf.error(xhr.responseJSON?.msg || 'Gagal memproses Top Up');
                        }
                    });

                } else {
                    $.ajax({
                        url: '{{ route('user_withdraw') }}',
                        method: 'POST',
                        data: {
                            amount: amount,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(res) {
                            setLoading(false);

                            if (res.new_balance !== undefined) {
                                let formattedBalance = new Intl.NumberFormat('id-ID').format(res
                                    .new_balance);
                                $('#saldo-display').text(formattedBalance);

                                let saldoWrapper = $('#saldo-display').closest('h1');
                                saldoWrapper.addClass(
                                    'text-red-400 transition-colors duration-300');
                                setTimeout(() => saldoWrapper.removeClass('text-red-400'), 800);
                            }

                            notyf.success(res.msg || 'Penarikan berhasil');
                            $('.close-modal').click();
                        },
                        error: function(xhr) {
                            setLoading(false);
                            let msg = xhr.responseJSON?.msg || 'Gagal melakukan penarikan';
                            $('#errorMsg').removeClass('hidden').text(msg);
                            inputAmount.addClass('border-red-500');
                            notyf.error(msg);
                        }
                    });
                }
            });

            function handleTopupSuccess(serverRes, midtransRes) {
                notyf.success('Pembayaran berhasil! Memverifikasi...');

                $.ajax({
                    url: '{{ route('user_topup_complete') }}',
                    method: 'POST',
                    data: {
                        blcid: serverRes.blcid,
                        transaction_status: midtransRes.transaction_status,
                        payment_type: midtransRes.payment_type,
                        gross_amount: midtransRes.gross_amount,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(resp) {

                        notyf.success(resp.msg || 'Saldo berhasil ditambahkan');

                        setTimeout(() => {
                            location.reload();
                        }, 600);
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        notyf.error('Gagal verifikasi saldo, silakan cek riwayat');
                        setTimeout(() => {
                            location.reload();
                        }, 1200);
                    }
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            const main = $('#card-main');
            const cards = $('#card-profile, #card-password, #card-finger');

            function resetLayout() {
                cards.fadeOut(200).addClass('hidden');

                main
                    .removeClass('md:w-1/2')
                    .addClass('md:w-full');
            }

            function showCard(cardId) {
                main
                    .removeClass('md:w-full')
                    .addClass('md:w-1/2');

                cards.hide().addClass('hidden');

                setTimeout(() => {
                    $(cardId)
                        .removeClass('hidden')
                        .css({
                            opacity: 0,
                            transform: 'translateX(30px)'
                        })
                        .fadeIn(200)
                        .animate({
                            opacity: 1
                        }, {
                            duration: 300,
                            step: function() {
                                $(this).css('transform', 'translateX(0)');
                            }
                        });
                }, 200);
            }

            resetLayout();

            $('#btn-edit-profile').on('click', () => showCard('#card-profile'));
            $('#btn-ganti-password').on('click', () => showCard('#card-password'));
            $('#btn-finger').on('click', () => showCard('#card-finger'));

            $('.btn-cancel').on('click', function() {
                resetLayout();
            });

            const notyf = new Notyf({
                duration: 1500,
                position: {
                    x: 'right',
                    y: 'top'
                },
                ripple: true
            });

            let actionUrl = null;
            let actionMethod = 'GET';

            const confirmBtn = $('#confirmAction');
            const originalConfirmText = confirmBtn.html();

            function setLoading(isLoading, text = 'Loading...') {
                if (isLoading) {
                    confirmBtn
                        .prop('disabled', true)
                        .addClass('opacity-70 cursor-not-allowed')
                        .html(`<i class="fa fa-spinner fa-spin"></i>`);
                } else {
                    confirmBtn
                        .prop('disabled', false)
                        .removeClass('opacity-70 cursor-not-allowed')
                        .html(originalConfirmText);
                }
            }

            $(document).on('click', '.open-confirm-modal', function(e) {
                e.preventDefault();

                $('#confirmTitle').text($(this).data('title') || 'Konfirmasi');
                $('#confirmMessage').text($(this).data('message') || 'Apakah Anda yakin?');

                actionUrl = $(this).data('url');
                actionMethod = $(this).data('method') || 'GET';
            });

            confirmBtn.on('click', function() {
                if (!actionUrl) return;

                setLoading(true);

                $.ajax({
                    url: actionUrl,
                    type: actionMethod,
                    dataType: 'json',
                    success: function(res) {
                        if (res.msg) {
                            notyf.success(res.msg);
                        }

                        $('[data-modal-hide="global-confirm-modal"]').click();

                        if (res.redirect) {
                            setTimeout(() => {
                                window.location.href = res.redirect;
                            }, 800);
                        }
                    },
                    error: function(xhr) {
                        const res = xhr.responseJSON;
                        notyf.error(res?.msg || 'Terjadi kesalahan');
                    },
                    complete: function() {
                        setLoading(false);
                        actionUrl = null;
                    }
                });
            });

            const csrfToken = '{{ csrf_token() }}';
            const currentUserName = '{{ $user->usernm ?? '' }}';
            const currentUserEmail = '{{ $user->email ?? '' }}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // $('#btnTopup').on('click', function(e) {
            //     e.preventDefault();

            //     let amount = prompt('Masukkan jumlah Top Up (angka):');
            //     if (!amount) return;
            //     amount = parseFloat(amount);
            //     if (isNaN(amount) || amount <= 0) {
            //         notyf.error('Jumlah tidak valid');
            //         return;
            //     }

            //     $.ajax({
            //         url: '{{ route('user_topup') }}',
            //         method: 'POST',
            //         data: {
            //             amount: amount,
            //             usernm: currentUserName,
            //             email: currentUserEmail,
            //             _token: csrfToken
            //         },
            //         dataType: 'json',
            //         success: function(res) {
            //             console.log('user_topup response:', res);
            //             if (!res || !res.snap_token) {
            //                 console.error('No snap_token in response', res);
            //                 notyf.error(res?.msg || 'Tidak menerima snap token dari server');
            //                 return;
            //             }

            //             // call snap.pay directly (snap.js is included above)
            //             if (typeof window.snap === 'undefined') {
            //                 console.error('window.snap undefined - snap.js did not load');
            //                 notyf.error(
            //                     'Midtrans Snap tidak tersedia. Periksa koneksi atau konfigurasi.'
            //                 );
            //                 return;
            //             }

            //             try {
            //                 console.log('calling snap.pay with token', res.snap_token);
            //                 window.snap.pay(res.snap_token, {
            //                     onSuccess: function(result) {
            //                         $.post('{{ route('user_topup_complete') }}', {
            //                             blcid: res.blcid,
            //                             order_id: res.order_id,
            //                             transaction_status: result
            //                                 .transaction_status,
            //                             payment_type: result.payment_type,
            //                             gross_amount: result.gross_amount,
            //                             _token: csrfToken
            //                         }).done(function(resp) {
            //                             notyf.success(resp.msg ||
            //                                 'Topup berhasil');
            //                             setTimeout(function() {
            //                                 location.reload();
            //                             }, 800);
            //                         }).fail(function() {
            //                             notyf.error(
            //                                 'Gagal mengonfirmasi topup');
            //                         });
            //                     },
            //                     onPending: function(result) {
            //                         notyf.success('Pembayaran menunggu konfirmasi');
            //                     },
            //                     onError: function(result) {
            //                         notyf.error('Pembayaran gagal');
            //                     },
            //                     onClose: function() {}
            //                 });
            //             } catch (err) {
            //                 notyf.error('Kesalahan pembayaran');
            //             }
            //         },
            //         error: function(xhr) {
            //             console.error('user_topup error', xhr.status, xhr.responseText);
            //             let msg = 'Terjadi kesalahan';
            //             try {
            //                 msg = JSON.parse(xhr.responseText).msg || msg;
            //             } catch (e) {}
            //             notyf.error(msg);
            //         }
            //     });
            // });

            // Withdraw (Tarik Dana)
            $('#btnWindraw').on('click', function(e) {
                e.preventDefault();

                let amount = prompt('Masukkan jumlah yang ingin ditarik (angka):');
                if (!amount) return;
                amount = parseFloat(amount);
                if (isNaN(amount) || amount <= 0) {
                    notyf.error('Jumlah tidak valid');
                    return;
                }

                if (!confirm('Konfirmasi tarik dana sebesar ' + amount + ' ?')) return;

                $.ajax({
                    url: '{{ route('user_withdraw') }}',
                    method: 'POST',
                    data: {
                        amount: amount,
                        _token: csrfToken
                    },
                    dataType: 'json',
                    success: function(res) {
                        notyf.success(res.msg || 'Tarik dana berhasil');
                        setTimeout(function() {
                            location.reload();
                        }, 600);
                    },
                    error: function(xhr) {
                        notyf.error(xhr.responseJSON?.msg || 'Gagal tarik dana');
                    }
                });
            });
            $(document).on('click', '.btn-add-cart', function(e) {
                e.preventDefault();

                let button = $(this);
                let brgId = button.data('id');
                let icon = button.find('i');
                let originalClass = 'fa-solid fa-plus text-lg icon-plus';

                icon.attr('class', 'fa-solid fa-circle-notch fa-spin text-lg');

                $.ajax({
                    url: "{{ route('user_add_cart') }}",
                    type: "POST",
                    data: {
                        brgid: brgId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        let badge = $('#card-badge');
                        badge.text(response.total_cart);

                        badge.removeClass('scale-100').addClass('scale-150');
                        setTimeout(() => {
                            badge.removeClass('scale-150').addClass('scale-100');
                        }, 200);

                        icon.attr('class', 'fa-solid fa-check text-lg');

                        setTimeout(() => {
                            icon.attr('class', originalClass);
                        }, 1500);

                        if (typeof notyf !== 'undefined') {
                            notyf.success('Produk masuk keranjang');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        icon.attr('class', originalClass);

                        if (typeof notyf !== 'undefined') {
                            notyf.error('Gagal menambahkan produk');
                        } else {
                            alert('Gagal menambahkan produk');
                        }
                    }
                });
            });
            $(document).on('click', '.btn-update-qty', function(e) {
                e.preventDefault();

                let btn = $(this);
                let cartId = btn.data('id');
                let action = btn.data('action');
                let inputQty = $('#qty-input-' + cartId);
                let currentQty = parseInt(inputQty.val());

                if (action === 'minus' && currentQty <= 1) {
                    return;
                }

                btn.prop('disabled', true).addClass('opacity-50 cursor-not-allowed');

                $.ajax({
                    url: "{{ route('user_update_cart') }}",
                    type: "POST",
                    data: {
                        cartid: cartId,
                        action: action,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.status === true) {
                            inputQty.val(res.qty);

                            $('#item-total-' + cartId).text(res.item_total);

                            $('#summary-subtotal').text(res.subtotal);
                            $('#summary-pajak').text(res.pajak);
                            $('#summary-grand-total').text(res.grand_total);

                            if (typeof notyf !== 'undefined') {}
                        } else {
                            alert(res.msg);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        let msg = "Gagal mengupdate keranjang.";
                        if (xhr.responseJSON && xhr.responseJSON.msg) {
                            msg = xhr.responseJSON.msg;
                        }
                        alert(msg);
                    },
                    complete: function() {
                        btn.prop('disabled', false).removeClass(
                            'opacity-50 cursor-not-allowed');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let isCollapsed = false

            function updateLayoutPositions() {
                if (isCollapsed) {
                    $('#mainContent').removeClass('ml-0 md:ml-64').addClass('ml-0 md:ml-[5.5rem]');
                    $('#headerContainer').removeClass('left-0 md:left-[16.5rem]').addClass('left-[5.5rem]');
                } else {
                    $('#mainContent').removeClass('ml-0 md:ml-[5.5rem]').addClass('ml-0 md:ml-64');
                    $('#headerContainer').removeClass('left-[5.5rem]').addClass('left-0 md:left-[16.5rem]');
                }
            }

            const mobileBtn = $('#mobileMenuBtn');
            const closeBtn = $('#closeSidebarMobile');
            const sidebar = $('#sidebar');
            const overlay = $('#mobileOverlay');

            function toggleMobileMenu() {
                if (sidebar.hasClass('-translate-x-full')) {
                    sidebar.removeClass('-translate-x-full').addClass('translate-x-0');
                    overlay.removeClass('hidden');
                    setTimeout(() => {
                        overlay.removeClass('opacity-0');
                    }, 10);
                } else {
                    sidebar.addClass('-translate-x-full').removeClass('translate-x-0');
                    overlay.addClass('hidden');
                }
            }

            mobileBtn.on('click', toggleMobileMenu);
            closeBtn.on('click', toggleMobileMenu);
            overlay.on('click', toggleMobileMenu);

            $('#toggleSidebar').on('click', function() {
                isCollapsed = !isCollapsed

                if (isCollapsed) {
                    $('#sidebar')
                        .removeClass('w-64 p-6')
                        .addClass('w-20 p-3')

                    $('.sidebar-text').addClass('hidden')
                    $('.collapse-icon').addClass('hidden')

                    $('#sidebarTextLogo').addClass('hidden')
                    $('#sidebarImgLogo').removeClass('hidden')

                    $('#toggleIcon').addClass('rotate-180')
                } else {
                    $('#sidebar')
                        .removeClass('w-20 p-3')
                        .addClass('w-64 p-6')

                    $('.sidebar-text').removeClass('hidden')
                    $('.collapse-icon').removeClass('hidden')

                    $('#sidebarTextLogo').removeClass('hidden')
                    $('#sidebarImgLogo').addClass('hidden')

                    $('#toggleIcon').removeClass('rotate-180')
                }

                updateLayoutPositions();
            })

            $('[data-collapse-toggle]').each(function() {
                if ($('#sidebar').hasClass('w-20')) return;

                const button = $(this)
                const targetId = button.data('collapse-toggle')
                const target = $('#' + targetId)
                const icon = button.find('.collapse-icon')

                button.on('click', function() {
                    target.toggleClass('hidden')
                    icon.toggleClass('rotate-180')
                })
            })

        })
    </script>

</body>

</html>
