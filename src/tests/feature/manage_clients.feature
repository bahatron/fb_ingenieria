Feature: Manage clients
    As a (logged)User
    I want to create, update, delete and read clients
    So i can manage Clients

    Scenario: Create a Client
        Given the json: '{"name": "client name", "visible": true}'
        When I try to create a client
        Then I should have created a client on firestore
        And I should have go a document reference