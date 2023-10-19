<?php

namespace App\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

/**
 * FloorFunction ::= "Floor" "(" ArithmeticPrimary ")"
 */
class Floor extends FunctionNode
{
    // (1)
    public $FirstExpression = null;
    public $SecondExpression = null;
    public $SignExpression = null;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER); // (2)
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->FirstExpression = $parser->ArithmeticPrimary(); // (4)
        $parser->match(Lexer::T_DIVIDE); // (3)
        $this->SecondExpression = $parser->ArithmeticPrimary(); // (4)
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // (3)
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'floor(' .
            $this->FirstExpression->dispatch($sqlWalker) . '/' . $this->SecondExpression->dispatch($sqlWalker) .
            ')';
    }
}