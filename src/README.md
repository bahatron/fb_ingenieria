# Folder Structure

## Adapters

Adapters are objects that configure or setup any service external to the application, like axios, sentry or firebase

## Services

Services are objects that centralize a particular generic process, they contain no business rules and are accesible to both domain entities and applications

## Domain

Thi folder contains all our core logic and business rules.

According to Hexagonal architecture and following DDD this folder contains the inner domain of the application

Each domain has a index at their root, witch exports a facade object which exposes all features

## Function

> Hexagonal architecture: Application layer

Serverless functions application logic

## SPA

> Hexagonal architecture: Application layer

Single page application logic

## Tests

> Hexagonal architecture: Application layer

Testing application
