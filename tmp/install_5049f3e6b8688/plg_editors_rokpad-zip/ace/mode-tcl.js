/*
 * Version: MPL 1.1/GPL 2.0/LGPL 2.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 * The Original Code is Ajax.org Code Editor (ACE).
 *
 * The Initial Developer of the Original Code is
 * Ajax.org B.V.
 * Portions created by the Initial Developer are Copyright (C) 2010
 * the Initial Developer. All Rights Reserved.
 *
 * Alternatively, the contents of this file may be used under the terms of
 * either the GNU General Public License Version 2 or later (the "GPL"), or
 * the GNU Lesser General Public License Version 2.1 or later (the "LGPL"),
 * in which case the provisions of the GPL or the LGPL are applicable instead
 * of those above. If you wish to allow use of your version of this file only
 * under the terms of either the GPL or the LGPL, and not to allow others to
 * use your version of this file under the terms of the MPL, indicate your
 * decision by deleting the provisions above and replace them with the notice
 * and other provisions required by the GPL or the LGPL. If you do not delete
 * the provisions above, a recipient may use your version of this file under
 * the terms of any one of the MPL, the GPL or the LGPL.
 */
define("ace/mode/tcl",["require","exports","module","ace/lib/oop","ace/mode/text","ace/tokenizer","ace/mode/tcl_highlight_rules","ace/mode/matching_brace_outdent","ace/range"],function(c,e,a){var f=c("../lib/oop");
var d=c("./text").Mode;var h=c("../tokenizer").Tokenizer;var g=c("./tcl_highlight_rules").TclHighlightRules;var j=c("./matching_brace_outdent").MatchingBraceOutdent;
var b=c("../range").Range;var i=function(){this.$tokenizer=new h(new g().getRules());this.$outdent=new j();};f.inherits(i,d);(function(){this.toggleCommentLines=function(k,r,s,o){var q=true;
var t=/^(\s*)#/;for(var p=s;p<=o;p++){if(!t.test(r.getLine(p))){q=false;break;}}if(q){var l=new b(0,0,0,0);for(var p=s;p<=o;p++){var u=r.getLine(p);var n=u.match(t);
l.start.row=p;l.end.row=p;l.end.column=n[0].length;r.replace(l,n[1]);}}else{r.indentRows(s,o,"#");}};this.getNextLineIndent=function(p,l,n){var k=this.$getIndent(l);
var o=this.$tokenizer.getLineTokens(l,p);var q=o.tokens;if(q.length&&q[q.length-1].type=="comment"){return k;}if(p=="start"){var m=l.match(/^.*[\{\(\[]\s*$/);
if(m){k+=n;}}return k;};this.checkOutdent=function(m,k,l){return this.$outdent.checkOutdent(k,l);};this.autoOutdent=function(k,l,m){this.$outdent.autoOutdent(l,m);
};}).call(i.prototype);e.Mode=i;});define("ace/mode/tcl_highlight_rules",["require","exports","module","ace/lib/oop","ace/lib/lang","ace/mode/text_highlight_rules"],function(c,b,d){var e=c("../lib/oop");
var f=c("../lib/lang");var a=c("./text_highlight_rules").TextHighlightRules;var g=function(){var h=f.arrayToMap(("").split("|"));this.$rules={start:[{token:"comment",merge:true,regex:"#.*\\\\$",next:"commentfollow"},{token:"comment",regex:"#.*$"},{token:"support.function",regex:"[\\\\]$",next:"splitlineStart"},{token:"text",regex:'[\\\\](?:["]|[{]|[}]|[[]|[]]|[$]|[])'},{token:"text",regex:"^|[^{][;][^}]|[/\r/]",next:"commandItem"},{token:"string",regex:'[ ]*["](?:(?:\\\\.)|(?:[^"\\\\]))*?["]'},{token:"string",merge:true,regex:'[ ]*["]',next:"qqstring"},{token:"variable.instancce",merge:true,regex:"[$]",next:"variable"},{token:"support.function",regex:"!|\\$|%|&|\\*|\\-\\-|\\-|\\+\\+|\\+|~|===|==|=|!=|!==|<=|>=|<<=|>>=|>>>=|<>|<|>|!|&&|\\|\\||\\?\\:|\\*=|%=|\\+=|\\-=|&=|\\^=|{\\*}|;|::"},{token:function(i){if(h.hasOwnProperty(i)){return"keyword";
}else{return"identifier";}},regex:"[a-zA-Z_$][a-zA-Z0-9_$]*\\b"},{token:"paren.lparen",regex:"[[{]",next:"commandItem"},{token:"paren.lparen",regex:"[(]"},{token:"paren.rparen",regex:"[\\])}]"},{token:"text",regex:"\\s+"}],commandItem:[{token:"comment",merge:true,regex:"#.*\\\\$",next:"commentfollow"},{token:"comment",regex:"#.*$",next:"start"},{token:"string",regex:'[ ]*["](?:(?:\\\\.)|(?:[^"\\\\]))*?["]'},{token:"variable.instancce",merge:true,regex:"[$]",next:"variable"},{token:"support.function",regex:"(?:[:][:])[a-zA-Z0-9_/]+(?:[:][:])",next:"commandItem"},{token:"support.function",regex:"[a-zA-Z0-9_/]+(?:[:][:])",next:"commandItem"},{token:"support.function",regex:"(?:[:][:])",next:"commandItem"},{token:"support.function",regex:"!|\\$|%|&|\\*|\\-\\-|\\-|\\+\\+|\\+|~|===|==|=|!=|!==|<=|>=|<<=|>>=|>>>=|<>|<|>|!|&&|\\|\\||\\?\\:|\\*=|%=|\\+=|\\-=|&=|\\^=|{\\*}|;|::"},{token:"keyword",regex:"[a-zA-Z0-9_/]+",next:"start"}],commentfollow:[{token:"comment",regex:".*\\\\$",next:"commentfollow"},{token:"comment",merge:true,regex:".+",next:"start"}],splitlineStart:[{token:"text",regex:"^.",next:"start"}],variable:[{token:"variable.instancce",regex:"(?:[:][:])?(?:[a-zA-Z_]|\d)+(?:(?:[:][:])?(?:[a-zA-Z_]|\d)+)?(?:[(](?:[a-zA-Z_]|\d)+[)])?",next:"start"},{token:"variable.instancce",regex:"(?:[a-zA-Z_]|\d)+(?:[(](?:[a-zA-Z_]|\d)+[)])?",next:"start"},{token:"variable.instancce",regex:"{?(?:[a-zA-Z_]|\d)+}?",next:"start"}],qqstring:[{token:"string",regex:'(?:[^\\\\]|\\\\.)*?["]',next:"start"},{token:"string",merge:true,regex:".+"}]};
};e.inherits(g,a);b.TclHighlightRules=g;});define("ace/mode/matching_brace_outdent",["require","exports","module","ace/range"],function(c,b,d){var e=c("../range").Range;
var a=function(){};(function(){this.checkOutdent=function(f,g){if(!/^\s+$/.test(f)){return false;}return/^\s*\}/.test(g);};this.autoOutdent=function(k,l){var g=k.getLine(l);
var h=g.match(/^(\s*\})/);if(!h){return 0;}var i=h[1].length;var j=k.findMatchingBracket({row:l,column:i});if(!j||j.row==l){return 0;}var f=this.$getIndent(k.getLine(j.row));
k.replace(new e(l,0,l,i-1),f);};this.$getIndent=function(f){var g=f.match(/^(\s+)/);if(g){return g[1];}return"";};}).call(a.prototype);b.MatchingBraceOutdent=a;
});