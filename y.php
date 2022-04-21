<?php
declare(strict_types=1);

enum Type: int
{
    case OFFENSIVE = 1;
    case SPAM = 2;
    case IRRELEVANT = 3;
}
function p(mixed $x)
{
 print_r($x);
 echo "\n\n";
}


$enum_objects_as_list = Type::cases();
p($enum_objects_as_list); 

// [Type::OFFENSIVE, Type::SPAM, Type::IRRELEVANT]

$values_as_list = array_column(Type::cases(), 'value');
// [1, 2, 3]
p($values_as_list );

$names_as_list = array_column(Type::cases(), 'name');
// ['OFFENSIVE', 'SPAM', 'IRRELEVANT']
p($names_as_list );

$name_to_value_lookup = array_column(Type::cases(), 'value', 'name');
// ['OFFENSIVE' => 1, 'SPAM' => 2, 'IRRELEVANT' => 3]
p($name_to_value_lookup );

$value_to_name_lookup = array_column(Type::cases(), 'name', 'value');
// [1 => 'OFFENSIVE', 2 => 'SPAM', 3 => 'IRRELEVANT']
p($value_to_name_lookup );

$name_to_enum_object_lookup = array_column(Type::cases(), null, 'name');
// ['OFFENSIVE' => Type::OFFENSIVE, 'SPAM' => Type::SPAM, 'IRRELEVANT' => Type::IRRELEVANT]
p($name_to_enum_object_lookup );

$value_to_enum_object_lookup = array_column(Type::cases(), null, 'value');
// [1 => Type::OFFENSIVE, 2 => Type::SPAM, 3 => Type::IRRELEVANT]
p($value_to_enum_object_lookup );

