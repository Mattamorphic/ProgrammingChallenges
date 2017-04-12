# Challenge 2 : SLA #

## Problem ##
Given a created date, an end date, and a SLA day range (as an integer)
Return a boolean if the ticket has failed the given SLA day range

## Rules ##
- Do not take into account weekend days
- If possible take relative timezone into account

## Example ##
```If a ticket is raised on 06/03/2017 @ 08:00 in the UK
With a 9 day SLA
It will fail when compared with 17/03/2017 @ 10:00
And return false
```

 ```If a ticket is raised on 06/03/2017 @ 08:00 in Singapore
With a 9 day SLA
It will pass when compared with 17/03/2017 @ 10:00 (UK)
And return true```
