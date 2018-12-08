import Vue from "vue";
import $firebase from "firebase";

export interface FirebaseDocumentSnapshot<T> extends $firebase.firestore.DocumentSnapshot {
    data(options?: $firebase.firestore.SnapshotOptions | undefined): T | undefined;
}

export interface FirebaseDocumentReference<T> extends $firebase.firestore.DocumentReference {
    get(options?: $firebase.firestore.GetOptions | undefined): Promise<FirebaseDocumentSnapshot<T>>;
}

const config = {
    apiKey: process.env.VUE_APP_FIREBASE_API_KEY,
    authDomain: process.env.VUE_APP_FIREBASE_AUTH_DOMAIN,
    databaseURL: process.env.VUE_APP_FIREBASE_DATABASE_URL,
    projectId: process.env.VUE_APP_FIREBASE_DATABASE_URL,
};

$firebase.initializeApp(config);

// sets global access to firebase by calling this.$firebase
Vue.prototype.$firebase = $firebase;

export default $firebase;
