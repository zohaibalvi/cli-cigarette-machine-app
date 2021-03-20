# Setup
System requirements:
- PHP 7.*
- Composer

### Introduction
It is a small CLI cigarette machine application that uses the
fundamental concept of object-oriented programming. The input 
should be the amount of packs of a potential customer could want 
and the amount he is going to give. Currently, the price per cigarette 
pack is a static 4,99, and we are not focusing about the currency so 
should assume that it's in Euro!

#### User Input
User should run the command on CLI with number of cigarette packs and amount.

#### Desired Output
The result should be printed on the screen with the count and 
the total amount of the purchased packs as well as a table 
which tells the customer in which coin combination he is going
to get his change.

Example 01:

```
// Input
$ php bin/console purchase-cigarettes 2 15.00

// Output
You bought 2 packs of cigarettes for 9.98, each for 4.99.

Your change is:5.02

+-------+-------+
| Coins | Count |
+-------+-------+
| 2.00  | 2     |
| 1.00  | 1     |
| 0.02  | 1     |
+-------+-------+

```

Example 02:
```
// Input
$ php bin/console purchase-cigarettes 2 5.00

// Output
You bought 2 packs of cigarettes for 9.98, each for 4.99.
Unfortunatly, you have to pay 4.98 more!

```

## License
[MIT](https://choosealicense.com/licenses/mit/)