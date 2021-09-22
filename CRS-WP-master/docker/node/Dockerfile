########################################################################################################################
# BASE
########################################################################################################################
ARG NODE_VERSION

FROM node:${NODE_VERSION}-alpine as base

RUN set -xe \
    && apk update \
    && apk add shadow bash \
       chromium \
       nss \
       freetype \
       freetype-dev \
       harfbuzz \
       ca-certificates \
       ttf-freefont \
       python \
       lcms2-dev \
       libpng-dev \
       build-base

RUN set -xe \
    && install -d -m 0755 -o node -g node \
        /home/node/.cache/ \
        /app \
        /app/node_modules \
        /app/dist

########################################################################################################################
# DEVELOPMENT
########################################################################################################################

#
# gosu
#
# see: https://github.com/tianon/gosu
#
FROM golang:alpine as gosu

RUN set -xe \
    && apk add --no-cache git \
    && go get github.com/tianon/gosu

#
# Development image
#
FROM base as development

# Tell Puppeteer to skip installing Chrome. We'll be using the installed package.
ENV PUPPETEER_SKIP_CHROMIUM_DOWNLOAD true       

# gosu
COPY --from=gosu /go/bin/gosu /usr/sbin/gosu

# scripts
COPY ./scripts /usr/local/bin/

RUN set -xeu \
    && yarn global add npx create-guten-block

ENTRYPOINT ["docker-entrypoint-dev"]
