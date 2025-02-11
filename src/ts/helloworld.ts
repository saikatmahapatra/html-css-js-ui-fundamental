let message: string = 'Hello World';
console.log(message);

type CustomRequest<CustomType> = {
    url: string;
    data: CustomType;
};

const request: CustomRequest<string> = {
    url: 'https://typescript.tv/',
    data: 'example',
};