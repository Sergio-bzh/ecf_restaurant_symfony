<?php

namespace App\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

/**
 * QuarterTimeFunction ::= "QuarterTime" "(" ArithmeticPrimary ")"
 */
class QuarterTime extends FunctionNode
{
    // (1)
    public $FirstExpression = null;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER); // (2)
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->FirstExpression = $parser->ArithmeticPrimary(); // (4)
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // (3)
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'Floor(minute(' . $this->FirstExpression->dispatch($sqlWalker) . ') / 15) * 15';
    }
}