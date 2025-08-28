<?php

namespace Mpietrucha\Utility\Tokenizer\Contracts;

interface InteractsWithTokens
{
    public const int ABSTRACT = T_ABSTRACT;

    public const int AMPERSAND_FOLLOWED_BY_VAR_OR_VARARG = T_AMPERSAND_FOLLOWED_BY_VAR_OR_VARARG;

    public const int AMPERSAND_NOT_FOLLOWED_BY_VAR_OR_VARARG = T_AMPERSAND_NOT_FOLLOWED_BY_VAR_OR_VARARG;

    public const int AND_EQUAL = T_AND_EQUAL;

    public const int ARRAY = T_ARRAY;

    public const int ARRAY_CAST = T_ARRAY_CAST;

    public const int AS = T_AS;

    public const int ATTRIBUTE = T_ATTRIBUTE;

    public const int BAD_CHARACTER = T_BAD_CHARACTER;

    public const int BOOLEAN_AND = T_BOOLEAN_AND;

    public const int BOOLEAN_OR = T_BOOLEAN_OR;

    public const int BOOL_CAST = T_BOOL_CAST;

    public const int BREAK = T_BREAK;

    public const int CALLABLE = T_CALLABLE;

    public const int CASE = T_CASE;

    public const int CATCH = T_CATCH;

    public const int CLASS_NAME = T_CLASS;

    public const int CLASS_CONSTANT = T_CLASS_C;

    public const int CLONE = T_CLONE;

    public const int CLOSE_TAG = T_CLOSE_TAG;

    public const int COALESCE = T_COALESCE;

    public const int COALESCE_EQUAL = T_COALESCE_EQUAL;

    public const int COMMENT = T_COMMENT;

    public const int CONCAT_EQUAL = T_CONCAT_EQUAL;

    public const int CONST = T_CONST;

    public const int CONSTANT_ENCAPSED_STRING = T_CONSTANT_ENCAPSED_STRING;

    public const int CONTINUE = T_CONTINUE;

    public const int CURLY_OPEN = T_CURLY_OPEN;

    public const int DEC = T_DEC;

    public const int DECLARE = T_DECLARE;

    public const int DEFAULT = T_DEFAULT;

    public const int DIR = T_DIR;

    public const int DIV_EQUAL = T_DIV_EQUAL;

    public const int DNUMBER = T_DNUMBER;

    public const int DO = T_DO;

    public const int DOC_COMMENT = T_DOC_COMMENT;

    public const int DOLLAR_OPEN_CURLY_BRACES = T_DOLLAR_OPEN_CURLY_BRACES;

    public const int DOUBLE_ARROW = T_DOUBLE_ARROW;

    public const int DOUBLE_CAST = T_DOUBLE_CAST;

    public const int DOUBLE_COLON = T_DOUBLE_COLON;

    public const int ECHO = T_ECHO;

    public const int ELLIPSIS = T_ELLIPSIS;

    public const int ELSE = T_ELSE;

    public const int ELSEIF = T_ELSEIF;

    public const int EMPTY = T_EMPTY;

    public const int ENCAPSED_AND_WHITESPACE = T_ENCAPSED_AND_WHITESPACE;

    public const int ENDDECLARE = T_ENDDECLARE;

    public const int ENDFOR = T_ENDFOR;

    public const int ENDFOREACH = T_ENDFOREACH;

    public const int ENDIF = T_ENDIF;

    public const int ENDSWITCH = T_ENDSWITCH;

    public const int ENDWHILE = T_ENDWHILE;

    public const int ENUM = T_ENUM;

    public const int END_HEREDOC = T_END_HEREDOC;

    public const int EVAL = T_EVAL;

    public const int EXIT = T_EXIT;

    public const int EXTENDS = T_EXTENDS;

    public const int FILE = T_FILE;

    public const int FINAL = T_FINAL;

    public const int FINALLY = T_FINALLY;

    public const int FN = T_FN;

    public const int FOR = T_FOR;

    public const int FOREACH = T_FOREACH;

    public const int FUNCTION = T_FUNCTION;

    public const int FUNC_CONSTANT = T_FUNC_C;

    public const int GLOBAL = T_GLOBAL;

    public const int GOTO = T_GOTO;

    public const int HALT_COMPILER = T_HALT_COMPILER;

    public const int IF = T_IF;

    public const int IMPLEMENTS = T_IMPLEMENTS;

    public const int INC = T_INC;

    public const int INCLUDE = T_INCLUDE;

    public const int INCLUDE_ONCE = T_INCLUDE_ONCE;

    public const int INLINE_HTML = T_INLINE_HTML;

    public const int INSTANCEOF = T_INSTANCEOF;

    public const int INSTEADOF = T_INSTEADOF;

    public const int INTERFACE_NAME = T_INTERFACE;

    public const int INT_CAST = T_INT_CAST;

    public const int ISSET = T_ISSET;

    public const int IS_EQUAL = T_IS_EQUAL;

    public const int IS_GREATER_OR_EQUAL = T_IS_GREATER_OR_EQUAL;

    public const int IS_IDENTICAL = T_IS_IDENTICAL;

    public const int IS_NOT_EQUAL = T_IS_NOT_EQUAL;

    public const int IS_NOT_IDENTICAL = T_IS_NOT_IDENTICAL;

    public const int IS_SMALLER_OR_EQUAL = T_IS_SMALLER_OR_EQUAL;

    public const int LINE = T_LINE;

    public const int LIST = T_LIST;

    public const int LNUMBER = T_LNUMBER;

    public const int LOGICAL_AND = T_LOGICAL_AND;

    public const int LOGICAL_OR = T_LOGICAL_OR;

    public const int LOGICAL_XOR = T_LOGICAL_XOR;

    public const int MATCH = T_MATCH;

    public const int METHOD_CONSTANT = T_METHOD_C;

    public const int MINUS_EQUAL = T_METHOD_C;

    public const int MOD_EQUAL = T_MOD_EQUAL;

    public const int MUL_EQUAL = T_MUL_EQUAL;

    public const int NAMESPACE = T_NAMESPACE;

    public const int NAMESPACE_FULLY_QUALIFIED = T_NAME_FULLY_QUALIFIED;

    public const int NAMESPACE_QUALIFIED = T_NAME_QUALIFIED;

    public const int NAMESPACE_RELATIVE = T_NAME_RELATIVE;

    public const int NEW = T_NEW;

    public const int NS_CONSTANT = T_NS_C;

    public const int NS_SEPARATOR = T_NS_SEPARATOR;

    public const int NUM_STRING = T_NUM_STRING;

    public const int OBJECT_CAST = T_OBJECT_CAST;

    public const int OBJECT_OPERATOR = T_OBJECT_OPERATOR;

    public const int NULLSAFE_OBJECT_OPERATOR = T_NULLSAFE_OBJECT_OPERATOR;

    public const int OPEN_TAG = T_OPEN_TAG;

    public const int OPEN_TAG_WITH_ECHO = T_OPEN_TAG_WITH_ECHO;

    public const int OR_EQUAL = T_OR_EQUAL;

    public const int PAAMAYIM_NEKUDOTAYIM = T_PAAMAYIM_NEKUDOTAYIM;

    public const int PLUS_EQUAL = T_PLUS_EQUAL;

    public const int POW = T_POW;

    public const int POW_EQUAL = T_POW_EQUAL;

    public const int PRINT = T_PRINT;

    public const int PRIVATE = T_PRIVATE;

    public const int PRIVATE_SET = T_PRIVATE_SET;

    public const int PROPERTY_CONSTANT = T_PROPERTY_C;

    public const int PROTECTED = T_PROTECTED;

    public const int PROTECTED_SET = T_PROTECTED_SET;

    public const int PUBLIC = T_PUBLIC;

    public const int PUBLIC_SET = T_PUBLIC_SET;

    public const int READONLY = T_READONLY;

    public const int REQUIRE = T_REQUIRE;

    public const int REQUIRE_ONCE = T_REQUIRE_ONCE;

    public const int RETURN = T_RETURN;

    public const int SL = T_SL;

    public const int SL_EQUAL = T_SL_EQUAL;

    public const int SPACESHIP = T_SPACESHIP;

    public const int SR = T_SR;

    public const int SR_EQUAL = T_SR_EQUAL;

    public const int START_HEREDOC = T_START_HEREDOC;

    public const int STATIC = T_STATIC;

    public const int STRING = T_STRING;

    public const int STRING_CAST = T_STRING_CAST;

    public const int STRING_VARNAME = T_STRING_VARNAME;

    public const int SWITCH = T_SWITCH;

    public const int THROW = T_THROW;

    public const int TRAIT_NAME = T_TRAIT;

    public const int TRAIT_CONSTANT = T_TRAIT_C;

    public const int TRY = T_TRY;

    public const int UNSET = T_UNSET;

    public const int UNSET_CAST = T_UNSET_CAST;

    public const int USE = T_USE;

    public const int VAR = T_VAR;

    public const int VARIABLE = T_VARIABLE;

    public const int WHILE = T_WHILE;

    public const int WHITESPACE = T_WHITESPACE;

    public const int XOR_EQUAL = T_XOR_EQUAL;

    public const int YIELD = T_YIELD;

    public const int YIELD_FROM = T_YIELD_FROM;
}
