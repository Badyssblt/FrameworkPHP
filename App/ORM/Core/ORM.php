<?php

namespace App\ORM\Core;

use ReflectionClass;

class ORM {
    public static function map($entityClass) {
        $reflectionClass = new ReflectionClass('src\\Entity\\' . $entityClass);
        $propertiesMapping = []; 
        
        foreach ($reflectionClass->getProperties() as $property) {
            $attributes = $property->getAttributes(\App\ORM\Annotations\ORM::class);
            
            foreach ($attributes as $attribute) {
                $ormAnnotation = $attribute->newInstance(); 
                $propertyName = $property->getName();
                $propertyType = $ormAnnotation->columnType; 
                
                $propertiesMapping[$propertyName] = [
                    'type' => $propertyType,
                ];
            }
        }
    
        (new DbCreator($propertiesMapping))->createTable($entityClass);
    }

}