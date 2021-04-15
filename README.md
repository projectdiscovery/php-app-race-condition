# Vulnerable PHP App (Race Condition)


## Environment setup:

```
docker-compose up
```

## Environment verification:

Connection Test:
http://localhost/test.php

Vulnerable endpoint:
http://localhost/poc.php

## Race condition exploit:

```
echo http://localhost | nuclei -t race.yml
```

Observe that less than 1280$ were accounted for withdraw from the balance (10$ * 128 requests) with a variable net gain.


#### Reference: https://defuse.ca/race-conditions-in-web-applications.htm
