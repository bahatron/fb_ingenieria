import "dotenv/config";

function setupTestEnv(): void {
    console.log("configuring test environment... ");

    const env: any = {
        VUE_APP_DB_CLIENT_PATH: "test/clients",
        VUE_APP_SENTRY_DSN: "",
    };

    Object.keys(env).forEach((key) => {
        process.env[key] = env[key];
    });

    console.log("test environment configured!");
}

function closeDatabaseConnection() {
    console.log("closing firebase connection..");

    const $firebase = require("../src/services/firebase").default;
    $firebase.database().goOffline();

    console.log("connection to firebase closed!");
}

before(() => {
    setupTestEnv();

    console.log("global before hook complete! \n");
});

after(() => {
    closeDatabaseConnection();
});
