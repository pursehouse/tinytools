<?php

namespace Pursehouse\TinyTools;

class Mock implements \IteratorAggregate, \ArrayAccess, \JsonSerializable {
    private $values = [];

    public function __construct( $data = [] ) {

        foreach( $data as $k => $v ) {
            $this->{$k} = $v;
        }

    }

    public function __set( $name, $value ) {

        return $this->values[ $name ] = $value;

    }

    public function __get( $name ) {

        $expl = explode( '_', $name );
        $count = (int)array_pop( $expl );
        $type = array_pop( $expl );
        switch( $type ) {
            case 'int':
                return $this->values[ $name ] = rand( 1, $count );
            break;
            case 'float':
                return $this->values[ $name ] = rand( 1, $count * 100 ) / 100;
            break;
            case 'array':
                if( $count > 0 ) {
                    return $this->values[ $name ] = new Mock( array_fill( 0, $count, new Mock() ) );
                }
            break;
        }

        return $this->values[ $name ] = $name;

    }

    public function getIterator() {

        return new \ArrayIterator( $this->values );

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

        return isset( $this->values[ $offset ] );

    }

    public function offsetSet( $offset, $value ) {

        if( is_null( $offset ) )
            $this->values[] = $value;
        else
            $this->values[ $offset ] = $value;

    }
}
