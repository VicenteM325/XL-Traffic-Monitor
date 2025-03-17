import Echo from "laravel-echo";
import { gsap } from 'gsap';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

window.Echo.channel('semaforos')
    .listen('SemaforoActualizado', (data) => {
        console.log('Semaforo actualizado:', data.semaforo);
        // Actualizar la vista con los nuevos tiempos del semáforo
        const semaforoElement = document.getElementById(`semaforo-${data.semaforo.id}`);
        if (semaforoElement) {
            semaforoElement.innerHTML = `
                Verde: ${data.semaforo.tiempo_verde}s,
                Amarillo: ${data.semaforo.tiempo_amarillo}s,
                Rojo: ${data.semaforo.tiempo_rojo}s
            `;
        }
    });