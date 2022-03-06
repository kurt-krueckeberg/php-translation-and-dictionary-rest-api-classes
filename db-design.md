<div class="container">

## Abbreviations Used

The abbreviations ins the ding.txt files are on the page at [Dictionary De - En: Abbreviations](https://dict.tu-chemnitz.de/de-en/abb.en.html). These abbreviations appear
in the ding.txt file in enclose like so:

 ---------------------------------------------
 Abbreviation   Part of Speech 
 -------------- ------------------------------
 {n}            noun, masculine (der)

 {f}            noun, feminine (die)

 {n}            noun, neuter (das)

 {pl}           noun, plural (die)

 {vt}           verb, transitive

 {vi}           verb, intransitive

 {vr}           verb, reflexive

 {v}            other verb, or verbal phrase

 {adj}          adjective

 {adv}          adverb; adverbial phrase

 {prp}          preposition

 {num}          numeral

 {art}          article 

 {ppron}        personal pronoun

 {pron}         pronoun

 {conj}         conjunction 

 {interj}       interjection
 -------------- ------------------------------

 Table: Dictionary ding.txt abbreviations 

## Prospective Database Design

This is beginning prospective MySQL relational database design (one possible design) for storing some of the ding.txt fields.

### Custom Annotation Field

A general category field will designate the high-level category of the word. It also signals if other tables provide further essential information as described below:

 -------- -----------------
 cat      Explantion
 -------- -----------------
 n        Noun
 virr     Irregular Verb
 vw       Weak Verb
 o        Other
 -------- ----------------

### Prospecitve Tables

 ------------ -------------------------------- -------------------------------------------------------------------------------------------------
 id            cat                             word             abbrev                                                                      
 ------------  ------------------------------- ---------------- --------------------------------------------------------------------------------
 primary key   Top-level category of the word  German Word      Part of speech abbreviation with curly braces `{}` found in the ding.txt file
 ------------  ------------------------------- ---------------- --------------------------------------------------------------------------------
 
 TABLE: Words (words)

 ------------ --------------------------------------------------------------------------------------------
 id           id_word            Case                                weak
 ------------ ------------------ ----------------------------------- -------------------------------------
 primary key  Foreign Key id\    m/f/n  for masculaine, feminine,\   y/n flag, where y implies it is a\
              from Words table   or neuter                           weak noun.
 ------------ ------------------ ----------------------------------- --------------------------------------
 
 TABLE: Nouns (nouns) 

 ------------ --------------------------------------------------------------------------------------------
 id           id_word            Conjuation                          Sein
 ------------ ------------------ ----------------------------------- -------------------------------------
 primary key  Foreign Key id\    m/f/n  for masculaine, feminine,\   y/n flag, where y implies it is a\
              from Words table   or neuter                           weak noun.
 ------------ ------------------ ----------------------------------- --------------------------------------
 
 TABLE: Irregular Verbs (irr_verbs) 

**Comment:** The way ding.txt designates irregular verbs and "conjugates" them seems to be inconsistent. How one should parse it is not documented (apparently), and I would therefore need to mode existing software
that knows how to parse it.

### SQL

 TABLE: Words: Column Descriptioins

```sql
CREATE TABLE Words (
 id int(11) NOT NULL AUTO_INCREMENT,
  Word varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
)
```

</div>
