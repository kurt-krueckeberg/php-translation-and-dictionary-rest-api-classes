## Understading XPath

- Excellent [Ultimate XPath Writing Cheat Sheet Tutorial with Syntax and Examples](https://www.softwaretestinghelp.com/xpath-writing-cheat-sheet-tutorial-examples/) 

- Good :[XPath Cheat Sheet](https://hackr.io/blog/xpath-cheat-sheet)

- [XPath cheatsheet](https://www.scraperapi.com/blog/xpath-cheat-sheet/)

- [Extensive XPath cheatsheet](https://www.lambdatest.com/blog/most-exhaustive-xpath-locators-cheat-sheet/)


//span[@class='gramGrp pos']
//span[@class='gramGrp']/span[class='pos']

//span[@class='gramGrp pos']/text()
//span[@class='gramGrp']/span[class='pos']/text()

## Comments on Gender xpaths:

The gender often is in this span with these two classes: <span class="gramGrp pos">masculine noun</span>
But sometimes, like with Unverständnis' it is in a nested span::<span class="gramGrp"><span class="pos">neuter noun</span>....</span> 
For words (like those for occupations) that have both masculine and feminine (-in) forms, it gets even more complicated. You then have two nested spans:
<span class="gramGrp"><span class="pos">masculine noun</span><span>,</span> <span class="pos">feminine noun</span></span>


## Comments on Plural xpath

TODO.

## Snippets

Befund 

xpath to gender= `//*[@id="befund_1.1"]/span[2]`
full xpath=`/html/body/div[1]/div/div/span[2]`

```html
<div class="entry_container">
  <div class="entry lang_de" id="befund_1">
    <h1 class="hwd">
      <span class="inline">Befund</span>
    </h1>
    <div class="hom" id="befund_1.1">
      <span>&nbsp;</span> <span class="gramGrp pos">masculine noun</span>
      <div class="sense">
        <span class="cit lang_en-gb quote">results <em class="hi">pl</em></span><span class="cit" id="befund_1.2"><span>; &nbsp;</span> <span class="quote">der Befund war positiv/negativ</span> <span class="lbl"><span>(</span>medicine<span>)</span></span> <span class="cit lang_en-gb quote">the results were positive/negative</span></span><span class="cit" id="befund_1.3"><span>; &nbsp;</span> <span class="quote">ohne Befund</span> <span class="lbl"><span>(</span>medicine<span>)</span></span> <span class="cit lang_en-gb quote">(results) negative</span></span>
      </div><!-- End of DIV sense-->
    </div><!-- End of DIV hom-->
  </div><!-- End of DIV entry lang_de-->
</div>
```

Facharbeiter
Facharbeiter

xpath to gender
`//*[@id="facharbeiter_1.1"]/span[2]/span[1]`
`//*[@id="facharbeiter_1.1"]/span[2]/span[3]`

```html
<div class="entry_container">
  <div class="entry lang_de" id="facharbeiter_1">
    <h1 class="hwd">
      <span class="inline">Facharbeiter</span>
    </h1><span class="inline orth"><span class="bluebold">,</span> in</span>
    <div class="hom" id="facharbeiter_1.1">
      <span>&nbsp;</span> <span class="gramGrp"><span class="pos">masculine noun</span><span>,</span> <span class="pos">feminine noun</span></span>
      <div class="sense">
        <span class="cit lang_en-gb quote">skilled worker</span>
      </div><!-- End of DIV sense-->
    </div><!-- End of DIV hom-->
  </div><!-- End of DIV entry lang_de-->
</div>
```

Ruhm
xpath to gender
`//*[@id="ehre_1.1"]/span[2]`

```html
<div class="entry_container">
  <div class="entry lang_de" id="ruhm_1">
    <h1 class="hwd">
      <span class="inline">Ruhm</span>
    </h1><span class="inline"><span>[</span><span class="pron" type="">ruːm<a href="#" class="playback"><img src="https://api.collinsdictionary.com/external/images/redspeaker.gif?version=2016-11-09-0913" alt="Pronunciation for Ruhm" class="sound c1" title="Pronunciation for Ruhm"></a><audio type="pronunciation" title="Ruhm"><span class="pron" type=""><source type="audio/mpeg" src="https://api.collinsdictionary.com/media/sounds/sounds/d/de_/de_w0/de_w0031310.mp3">Your browser does not support HTML5 audio.</span></audio></span><span>]</span></span>
    <div class="hom" id="ruhm_1.1">
      <span>&nbsp;</span> <span class="gramGrp pos">masculine noun</span><span class="inline"><span class="orth"><span class="bluebold">,</span> Ruhm(e)s</span> <span class="lbl">genitive</span><span class="gramGrp subc"><span>,</span> no plural</span></span>
      <div class="sense">
        <span class="cit lang_en-gb quote">glory</span>
        <div class="sense">
          <span class="bold">&nbsp; a&nbsp;</span><span class="lbl"><span>(=&nbsp;</span>Berühmtheit<span>)</span></span> <span class="cit lang_en-gb quote">fame</span>
        </div><!-- End of DIV sense-->
        <div class="sense">
          <span class="bold">&nbsp; b&nbsp;</span><span class="lbl"><span>(=&nbsp;</span>Lob<span>)</span></span> <span class="cit lang_en-gb quote">praise</span>
        </div><!-- End of DIV sense--><span class="cit" id="ruhm_1.2"><span>; &nbsp;</span> <span class="quote">zu Ruhm gelangen</span> <span class="cit lang_en-gb quote">to become famous</span></span><span class="cit" id="ruhm_1.3"><span>; &nbsp;</span> <span class="quote">sich in seinem Ruhm sonnen</span> <span class="cit lang_en-gb quote">to rest on one's laurels</span></span>
      </div><!-- End of DIV sense-->
    </div><!-- End of DIV hom-->
  </div><!-- End of DIV entry lang_de-->
</div>
```

Ehre

```html
<div class="entry_container">
  <div class="entry lang_de" id="ehre_1">
    <h1 class="hwd">
      <span class="inline">Ehre</span>
    </h1><span class="inline"><span>[</span><span class="pron" type="">ˈeːrə<a href="#" class="playback"><img src="https://api.collinsdictionary.com/external/images/redspeaker.gif?version=2016-11-09-0913" alt="Pronunciation for Ehre" class="sound c1" title="Pronunciation for Ehre"></a><audio type="pronunciation" title="Ehre"><span class="pron" type=""><source type="audio/mpeg" src="https://api.collinsdictionary.com/media/sounds/sounds/d/de_/de_w0/de_w0041350.mp3">Your browser does not support HTML5 audio.</span></audio></span><span>]</span></span>
    <div class="hom" id="ehre_1.1">
      <span>&nbsp;</span> <span class="gramGrp pos">feminine noun</span><span class="inline"><span class="orth"><span class="bluebold">,</span> Ehre</span> <span class="lbl">genitive</span></span><span class="inline"><span class="orth"><span class="bluebold">,</span> Ehren</span> <span class="lbl">plural</span></span>
      <div class="sense">
        <span class="cit lang_en-gb quote">honour <span class="lbl"><span>(</span>Brit<span>)</span></span></span><span>,</span> <span class="cit lang_en-gb quote">honor <span class="lbl"><span>(</span>US<span>)</span></span></span>
        <div class="sense">
          <span class="lbl"><span>(=&nbsp;</span>Ruhm<span>)</span></span> <span class="cit lang_en-gb quote">glory</span>
        </div><!-- End of DIV sense--><span class="cit" id="ehre_1.2"><span>; &nbsp;</span> <span class="quote">etw in Ehren halten</span> <span class="cit lang_en-gb quote">to treasure sth</span></span><span class="cit" id="ehre_1.3"><span>; &nbsp;</span> <span class="quote">damit/mit ihm können Sie Ehre einlegen</span> <span class="cit lang_en-gb quote">that/he is a credit to you</span></span><span class="cit" id="ehre_1.4"><span>; &nbsp;</span> <span class="quote">jdm Ehre machen</span> <span class="cit lang_en-gb quote">to do sb credit</span></span><span class="cit" id="ehre_1.5"><span>; &nbsp;</span> <span class="quote">jdm wenig Ehre machen</span> <span class="cit lang_en-gb quote">not to do sb any credit</span></span><span class="cit" id="ehre_1.6"><span>; &nbsp;</span> <span class="quote">zu seiner Ehre muss ich sagen, dass ...</span> <span class="cit lang_en-gb quote">in his favour <span class="lbl"><span>(</span>Brit<span>)</span></span><em class="hi">or</em> favor <span class="lbl"><span>(</span>US<span>)</span></span> I must say (that) ...</span></span><span class="cit" id="ehre_1.7"><span>; &nbsp;</span> <span class="quote">etw um der Ehre willen tun</span> <span class="cit lang_en-gb quote">to do sth for the hono(u)r of it</span></span><span class="cit" id="ehre_1.8"><span>; &nbsp;</span> <span class="quote">ein Mann von Ehre</span> <span class="cit lang_en-gb quote">a man of hono(u)r</span></span><span class="cit" id="ehre_1.9"><span>; &nbsp;</span> <span class="quote">er ist in Ehren ergraut</span> <span class="lbl"><span>(</span>formal<span>)</span></span></span><span class="re" id="ehre_1.10"><span>:</span> <span class="inline orth">er ist in Ehren alt geworden</span></span>
        <div class="sense">
          <span class="cit lang_en-gb quote">he has had a long and hono(u)rable life</span>
        </div><!-- End of DIV sense--><span class="cit" id="ehre_1.11"><span>; &nbsp;</span> <span class="quote">sein Wort/seine Kenntnisse in allen Ehren, aber ...</span> <span class="cit lang_en-gb quote">I don't doubt his word/his knowledge, but ...</span></span><span class="cit" id="ehre_1.12"><span>; &nbsp;</span> <span class="quote">sich <span class="lbl">dative</span> etw zur Ehre anrechnen</span> <span class="cit lang_en-gb quote">to count sth an hono(u)r</span></span><span class="cit" id="ehre_1.13"><span>; &nbsp;</span> <span class="quote">mit wem habe ich die Ehre?</span> <span class="lbl"><span>(</span>ironic</span><span class="lbl"><span>,</span> formal<span>)</span></span> <span class="cit lang_en-gb quote">with whom do I have the pleasure of speaking? <span class="lbl"><span>(</span>form<span>)</span></span></span></span><span class="cit" id="ehre_1.14"><span>; &nbsp;</span> <span class="quote">was verschafft mir die Ehre?</span> <span class="lbl"><span>(</span>ironic</span><span class="lbl"><span>,</span> formal<span>)</span></span> <span class="cit lang_en-gb quote">to what do I owe the hono(u)r (of your visit)?</span></span><span class="cit" id="ehre_1.15"><span>; &nbsp;</span> <span class="quote">es ist mir eine besondere Ehre, ...</span> <span class="lbl"><span>(</span>formal<span>)</span></span> <span class="cit lang_en-gb quote">it is a great hono(u)r for me ...</span></span><span class="cit" id="ehre_1.16"><span>; &nbsp;</span> <span class="quote">um der Wahrheit die Ehre zu geben ...</span> <span class="lbl"><span>(</span>formal<span>)</span></span> <span class="cit lang_en-gb quote">to be perfectly honest ...</span></span><span class="cit" id="ehre_1.17"><span>; &nbsp;</span> <span class="quote">wir geben uns die Ehre, Sie zu ... einzuladen</span> <span class="lbl"><span>(</span>formal<span>)</span></span> <span class="cit lang_en-gb quote">we request the hono(u)r of your company at ... <span class="lbl"><span>(</span>form<span>)</span></span></span></span><span class="cit" id="ehre_1.18"><span>; &nbsp;</span> <span class="quote">zu Ehren</span> <span class="gramGrp subc"> genitive</span> <span class="cit lang_en-gb quote">in hono(u)r of</span></span><span class="cit" id="ehre_1.19"><span>; &nbsp;</span> <span class="quote">Habe die Ehre!</span> <span class="lbl"><span>(</span>old-fashioned</span><span class="lbl"><span>,</span> Austria<span>)</span></span> <span class="lbl"><span>(</span>als Gruß<span>)</span></span> <span class="cit lang_en-gb quote">hello</span><span class="lbl"><span>(</span>beim Abschied<span>)</span></span> <span class="cit lang_en-gb quote">goodbye</span><span class="lbl"><span>(</span>als Ausdruck des Erstaunens<span>)</span></span> <span class="cit lang_en-gb quote">good heavens</span></span><span class="re" id="ehre_1.20">; &nbsp;</span>
        <div class="scbold">
          PROVERB
        </div><!-- End of DIV scbold--><span class="inline orth">Ehre, wem Ehre gebührt</span>
        <div class="sense">
          <span class="cit lang_en-gb quote">credit where credit is due</span>
        </div><!-- End of DIV sense-->
      </div><!-- End of DIV sense-->
    </div><!-- End of DIV hom-->
  </div><!-- End of DIV entry lang_de-->
</div>
```

Unverständnis

```html
<div class="entry_container">
  <div class="entry lang_de" id="unverständnis_1">
    <h1 class="hwd">
      <span class="inline">Unverständnis</span>
    </h1>
    <div class="hom" id="unverständnis_1.1">
      <span>&nbsp;</span> <span class="gramGrp"><span class="pos">neuter noun</span> <span class="gramGrp subc">no plural</span></span>
      <div class="sense">
        <span class="cit lang_en-gb quote">lack of understanding</span>
        <div class="sense">
          <span class="lbl"><span>(=&nbsp;</span>Nichterfassen<span>)</span></span>
          <div class="sense">
            <span class="lbl"><span>(</span>für Kunst etc<span>)</span></span> <span class="cit lang_en-gb quote">lack of appreciation</span>
          </div><!-- End of DIV sense-->
        </div><!-- End of DIV sense-->
      </div><!-- End of DIV sense-->
    </div><!-- End of DIV hom-->
  </div><!-- End of DIV entry lang_de-->
</div>
```
