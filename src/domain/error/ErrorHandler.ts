import $errorFactory from "./ErrorFactory";
import $sentry from "../../adapters/sentry";

const $errorHandler = {
    handle: (err: any): void => {
        if ($errorFactory.isError(err)) {
            // todo
        }

        $sentry.captureException(err);
    },
};

export default $errorHandler;
