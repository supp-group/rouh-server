// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here.
// Other Firebase libraries are not available in the service worker.
importScripts("https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js",);

if (firebase.messaging.isSupported()) {
    // Initialize the Firebase app in the service worker by passing in the
    // messagingSenderId.
    firebase.initializeApp({
        'messagingSenderId': "876460279982",
        'apiKey': "AIzaSyDty2rMks5aAgxbb86GEAeV1H7-KJzkrf0",
        'projectId': "notify-507ab",	
        'appId':  "1:876460279982:web:3db5dfc9ec1fddcc21453f"
    });

    // Retrieve an instance of Firebase Messaging so that it can handle background messages.
    const messaging = firebase.messaging();

    messaging.setBackgroundMessageHandler(function (payload) {
        console.log(
            "[firebase-messaging-sw.js] Received background message ",
            payload,
        );
      //  const { title, body, image, username } = payload.data;
      
        // Customize notification here
        const notificationTitle =payload.data.title|| "Background Message Title";
        const notificationOptions = {
            body:payload.data.body||"Background Message body." ,
            icon: payload.data.image|| "/itwonders-web-logo.png",
        };
       
        if (payload.data.username) {
            notificationOptions.body += ` - Sent by ${payload.data.username}`;
        }
        
        return self.registration.showNotification(
            notificationTitle,
            notificationOptions,
        );
    });
}