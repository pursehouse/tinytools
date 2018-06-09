
# Create a variable

```php
$mock = new \Pursehouse\TinyTools\Mock();
```

# Use property as a string

```php
echo $mock->name
```

# Use property as a integer

random value 1 to 10

```php
echo $mock->hits_int_10
```

# Use property as a float

random value 1 to 10

```php
echo $mock->somefloat_float_10
```


# Use as object with array property

```php
    foreach( $mock->fruits_array_2 as $k => $v ) {
```

# Use as aray with array property

```php
foreach( $mock['traits_array_2'] as $k => $v ) {
```

# Recursion


```php
$mock = new \Pursehouse\TinyTools\Mock();

foreach( $mock->fruits_array_2 as $k => $v ) {
    echo "$k\r\n";
    foreach( $v->traits_array_3 as $k2 => $v2 ) {
        echo "\t$k2\t{$v2->test}\r\n";
        foreach( $v2[ 'traits_array_2' ] as $k3 => $v3 ) {
            echo "\t\t$k3\t{$v3->test_int_10}\r\n";
            echo "\t\t$k3\t{$v3->test_float_10}\r\n";
        }
    }
    foreach( $v[ 'traits_array_2' ] as $k2 => $v2 ) {
        echo "\t$k2\t{$v2->test}\r\n";
    }
}
```