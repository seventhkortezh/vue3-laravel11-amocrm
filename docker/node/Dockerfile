FROM node:21.7.3-alpine3.20

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

WORKDIR /app
ENV PATH /app/node_modules/.bin:$PATH

RUN npm install -g @vue/cli
