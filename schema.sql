-- Run this first (in psql or pgAdmin Query Tool on the postgres database):
-- CREATE DATABASE classwall;
-- Then connect to classwall and run the rest.

CREATE TABLE messages (
    id         SERIAL PRIMARY KEY,
    author     VARCHAR(50) NOT NULL,
    body       TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT NOW()
);
