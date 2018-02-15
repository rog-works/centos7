FROM nginx:1.13-alpine

RUN apk update \
 && apk add openssl --no-cache \
 && mkdir -p /etc/pki/tls/certs \
 && mkdir -p /etc/pki/tls/private \
 && openssl genrsa 4096 > server.key \
 && openssl req -new -key server.key -out server.csr -subj '/C=JP/ST=Tokyo/L=Tokyo/O=Example Ltd./OU=Web/CN=example.com' \
 && openssl x509 -req -in server.csr -days 3650 -req -signkey server.key > server.crt \
 && mv server.crt /etc/pki/tls/certs/ \
 && mv server.key /etc/pki/tls/private/ \
 && rm -f server.csr

COPY ./etc/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
