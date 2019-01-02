import * as $sentry from "@sentry/browser";

const DSN = process.env.VUE_APP_SENTRY_DSN;

$sentry.init({ dsn: DSN });

export default $sentry;
