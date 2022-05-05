## Grid Examples

### First

```html
dl {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
}

<dl>
<dt>Title 1</dt>
<dd>Description 1</dd>
<dt>Title 2</dt>
<dd>Description 2</dd>
<dt>Title 3</dt>
<dd>Description 3</dd>
<dt>Title 4</dt>
<dd>Description 4</dd>
<dt>Title 5</dt>
<dd>Description 5</dd>
</dl>
```

### 2nd

```html
dl {
  display: grid;
  grid-template-columns: max-content auto;
}

dt {
  grid-column-start: 1;
}

dd {
  grid-column-start: 2;
}

<dl>
  <dt>Mercury</dt>
  <dd>Mercury (0.4 AU from the Sun) is the closest planet to the Sun and the smallest planet.</dd>
  <dt>Venus</dt>
  <dd>Venus (0.7 AU) is close in size to Earth, (0.815 Earth masses) and like Earth, has a thick silicate mantle around an iron core.</dd>
  <dt>Earth</dt>
  <dd>Earth (1 AU) is the largest and densest of the inner planets, the only one known to have current geological activity.</dd>
</dl>
```

## Flexbox Example


```html
<style>
      dl {
        display: flex;
        flex-flow: row wrap;
        border: solid #666;
        border-width: 1px 1px 0 0;
      }
      dt {
        flex-basis: 20%;
        padding: 2px 4px;
        background: #666;
        text-align: right;
        color: #fff;
      }
      dd {
        flex-basis: 70%;
        flex-grow: 1;
        margin: 0;
        padding: 2px 4px;
        border-bottom: 1px solid #666;
      }
    </style>
  </head>
  <body>
    <dl>
      <dt>CSS</dt>
      <dd>Cascading Style Sheets</dd>
      <dt>HTML</dt>
      <dd>HyperText Markup Language</dd>
    </dl>
```
