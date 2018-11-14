FROM node:8.12

RUN npm install -g npm@latest
RUN npm install -g pm2
RUN npm install -g firebase-tools
RUN npm install -g typescript
RUN pm2 install typescript

WORKDIR /usr/node/app

COPY . .

RUN npm install