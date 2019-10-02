## Summary

example: Widget corp's customers need to be able to see all the available widgets at once because they're having a hard time deciding which widget is right for them. Bob at Widget corp has found that their support team gets a lot of calls about widget selection and it's costing them many hours on the phone.

## User Story

As a Customer,
I need to be able to see all widgets at once,
So that I can compare them for shopping purposes

## Definition of Done

```gherkin
Given I am logged in as a customer
And I am on the '/widgets' page
Then I should see the following widgets:
  - Thing 1
  - Thing 2
  - Thing 3
And They should be sorted alphebetically
```
