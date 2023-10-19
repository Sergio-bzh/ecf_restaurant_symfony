<?php

namespace App\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

/**
 * CreneauFunction ::= "Creneau" "(" ArithmeticPrimary ")"
 */
class Creneau extends FunctionNode
{
    // (1)
    public $Expression = null;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER); // (2)
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->Expression = $parser->ArithmeticPrimary(); // (4)
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // (3)
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        // return "Hour(" . $this->Expression->dispatch($sqlWalker) . ") || ':' || (minute(" . $this->Expression->dispatch($sqlWalker) . ") div 15) * 15";
        return "CONCAT(LPAD(FORMAT(Hour(" . $this->Expression->dispatch($sqlWalker) . "), 0), 2, '0'), ':', LPAD(FORMAT((minute(" . $this->Expression->dispatch($sqlWalker) . ") div 15) * 15, 0), 2, '0'))";
        
    }
}