<?php

namespace Pursehouse\TinyTools;

class Mock implements \IteratorAggregate, \ArrayAccess, \JsonSerializable {

    private $values = [];
    private $name   = '';
    private $count  = '';
    private $type   = '';

    private function debug( $line ) {

        echo $line." : ".$this->name." : ".$this->type." : ".$this->count."\n";

    }

    public function __construct( $name = '' ) {

        $this->name     = $name;

        $expl           = explode( '_', $this->name );
        $this->count    = (int)array_pop( $expl ) ?: 2;
        $this->type     = array_pop( $expl );
        $this->subName  = array_pop( $expl ) ?: $this->name;

        switch( $this->type ) {
            case 'int':
                $this->values[ $this->name ] = rand( 1, $this->count );
            break;
            case 'float':
                $this->values[ $this->name ] = rand( 1, $this->count * 100 ) / 100;
            break;
            case 'array':
//
//                 for( $n = $this->count; $n != 0; $n-- ) {
//                     $this->values[ $this->name ][] = new Mock( $this->subname );
//                 }
            break;
        }

    }

    public function __toString() {

        return $this->name;

    }

    public function __set( $name, $value ) {

        return $this->values[ $name ] = $value;

    }

    public function __get( $name ) {

        return $this->values[ $name ] = new Mock( $name );

    }

    public function getIterator() {

        return new \ArrayIterator( array_fill( 0, $this->count, new Mock( $this->subname ) ) );
    }

    public function jsonSerialize() {

        return $this->values;

    }

    public function offsetUnset( $offset ) {

        unset( $this->values[ $offset ] );

    }

    public function offsetGet( $offset ) {

        return $this->values[ $offset ] ?? $this->__get( $offset );

    }

    public function offsetExists( $offset ) {

        return $offset <= $this->count;

    }

    public function offsetSet( $offset, $value ) {

        if( is_null( $offset ) )
            $this->values[] = $value;
        else
            $this->values[ $offset ] = $value;

    }
}
