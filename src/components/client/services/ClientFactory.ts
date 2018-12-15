import $error from "../../error/Error";

export interface Client {
    name: string;
    website?: string;
    image?: string;
    description?: string;
    visible: boolean;
}

const $clientFactory = {
    map(data: any): Client {
        const {
            name, website, description, visible, image,
        } = data;

        if (!name || typeof visible !== "boolean") {
            throw $error.ValidationException("name and visible are required for Client");
        }

        return {
            name,
            website: website || null,
            description: description || null,
            image: image || null,
            visible,
        };
    },
};

export default $clientFactory;
