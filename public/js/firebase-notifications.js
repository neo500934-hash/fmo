import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-app.js";
import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-messaging.js";

const firebaseConfig = {
  apiKey: "AIzaSyAEXGaxzqYmNPx4lv6h0xamdKNiT8e4Gao",
  authDomain: "momo-442f9.firebaseapp.com",
  projectId: "momo-442f9",
  storageBucket: "momo-442f9.firebasestorage.app",
  messagingSenderId: "801873527863",
  appId: "1:801873527863:web:5e9a1420c2af0e0498abb2"
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

async function registerForPushNotifications() {
  try {
    const permission = await Notification.requestPermission();
    if (permission !== 'granted') {
      console.log('Notification permission denied');
      return;
    }

    const token = await getToken(messaging, {
      vapidKey: 'BIAF6bY3ywM5H8KKOHUNjXKwxyz0NCH1uxbv4eqtBJEsy8DnTmJQCOt6Sxl45XZ7Fkwz8_4c1s_eLnzUtt97Y7w'
    });

    if (token) {
      await fetch('/device-token', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ token }),
      });
      console.log('Device registered for push notifications');
    }
  } catch (error) {
    console.error('Error registering for push notifications:', error);
  }
}

registerForPushNotifications();
