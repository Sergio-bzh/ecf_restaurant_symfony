<?php

namespace App\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

/**
 * DivFunction ::= "Div" "(" ArithmeticPrimary "," ArithmeticPrimary ")"
 */
class Div extends FunctionNode
{
    // (1)
    public $dividende = null;
    public $diviseur = null;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER); // (2)
        $parser->match(Lexer::T_OPEN_PARENTHESIS); // (3)
        $this->dividende = $parser->ArithmeticPrimary(); // (4)
        $parser->match(Lexer::T_COMMA);
        $this->diviseur = $parser->ArithmeticPrimary(); // (4)
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // (3)
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return $this->dividende->dispatch($sqlWalker) . ' DIV ' .
               $this->dividende->dispatch($sqlWalker);
    }
}