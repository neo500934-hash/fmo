importScripts('https://www.gstatic.com/firebasejs/10.7.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.7.0/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyAEXGaxzqYmNPx4lv6h0xamdKNiT8e4Gao",
  authDomain: "momo-442f9.firebaseapp.com",
  projectId: "momo-442f9",
  storageBucket: "momo-442f9.firebasestorage.app",
  messagingSenderId: "801873527863",
  appId: "1:801873527863:web:5e9a1420c2af0e0498abb2"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: '/favicon.ico',
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
});
