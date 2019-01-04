FROM node:10

RUN npm install -g firebase-tools
RUN npm install -g typescript@3
RUN npm install -g ts-node

WORKDIR /home/node/app

COPY . .

RUN npm install