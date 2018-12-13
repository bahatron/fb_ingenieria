import $error from "@/components/error/Error";

export interface Client {
    name: string;
    website?: string;
    imageUrl?: string;
    description?: string;
    visible: boolean;
}

const $clientMapper = Object.freeze({
    map(data: any): Client {
        const {
            name, website, description, visible, imageUrl,
        } = data;

        if (!name || typeof visible !== "boolean") {
            throw $error.ValidationException("name and visible are required for Client");
        }

        return {
            name,
            website: website || null,
            description: description || null,
            imageUrl: imageUrl || null,
            visible,
        };
    },
});

export default $clientMapper;
