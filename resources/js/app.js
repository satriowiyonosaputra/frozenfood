import './bootstrap';
import '../css/app.css';
import 'preline';
import Swal from 'sweetalert2'

document.addEventListener('livewire:navigated', () => {
window.HSStaticMethod.autoInit();
})

window.Swal = Swal

