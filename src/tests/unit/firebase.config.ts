import "dotenv/config";
import $firebase from "../../adapters/firebase";

function setupTestEnv(): void {
    console.log("configuring test environment... ");

    const env: any = {
        VUE_APP_DB_CLIENT_PATH: "test/clients",
        VUE_APP_SENTRY_DSN: "",
    };

    Object.keys(env).forEach((key) => {
        process.env[key] = env[key];
    });
}

function closeDatabaseConnection() {
    $firebase.database().goOffline();
}

before(() => {
    setupTestEnv();
});

after(() => {
    closeDatabaseConnection();
});
