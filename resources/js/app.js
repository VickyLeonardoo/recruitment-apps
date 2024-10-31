import './bootstrap';

import Alpine from 'alpinejs';
import ApexCharts from 'apexcharts';
import Swal from 'sweetalert2';

window.ApexCharts = ApexCharts;
window.Alpine = Alpine;
window.Swal = Swal; // Make Swal globally accessible

Alpine.start();