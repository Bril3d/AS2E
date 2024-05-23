import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: '466298ddc4e8b2c62154',
  cluster: "eu",
  encrypted: true,
});
