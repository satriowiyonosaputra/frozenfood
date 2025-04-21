import './bootstrap';
import '../css/app.css';
import 'preline';
import Swal from 'sweetalert2';

window.Swal = Swal;

// Preline autoInit saat halaman pertama dimuat
document.addEventListener('DOMContentLoaded', () => {
    if (window.HSStaticMethod && typeof window.HSStaticMethod.autoInit === 'function') {
        window.HSStaticMethod.autoInit();
    }
});

// Preline autoInit saat Livewire navigasi
document.addEventListener('livewire:navigated', () => {
    if (window.HSStaticMethod && typeof window.HSStaticMethod.autoInit === 'function') {
        window.HSStaticMethod.autoInit();
    }
});
