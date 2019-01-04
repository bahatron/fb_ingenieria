# Folder Structure

## Adapters

The adapters folder contains any adapter to third-party software we may require. Like axios or the firebase SDK

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
