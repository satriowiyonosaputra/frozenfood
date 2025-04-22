import './bootstrap';
import '../css/app.css';

import 'preline';
import Swal from 'sweetalert2';

window.Swal = Swal;

// Jalankan Preline autoInit saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    window.HSStaticMethod?.autoInit();
});

// Jalankan ulang Preline setelah Livewire navigasi
document.addEventListener('livewire:navigated', () => {
    window.HSStaticMethod?.autoInit();
});
