# CSS Grid and Flexbox

- [Mozilla Developer: Using Mutlti-Column Layouts](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Columns/Using_multi-column_layouts)

- [Grid Explanied](https://www.w3schools.com/css/css_grid.asp)

- [A Complete Guide to Grid](https://css-tricks.com/snippets/css/complete-guide-grid/)

- [A Complete Guide to Flexbox](https://css-tricks.com/snippets/css/a-guide-to-flexbox/)

- CSS [column properties](https://www.w3schools.com/Css/css3_multiple_columns.asp)

## Grid and Overflow

- [How to solve a CSS grid overflow](https://datacadamia.com/web/css/grid/overflow)

## Styling deinition lists (includes using grid)

[CSS: Formatting a Definition List](https://www.the-art-of-web.com/css/format-dl/)

``html
<!DOCTYPE html>
<html>
<head>
 <title>dt.html</title>
 <meta charset="UTF-8">
<style>
dl {
  display: grid;
  grid-template: auto / 200px 1fr;
}
dt, dd {
  margin: 0;
}
dt {
  background-color: #eee;
}
dd {
  background-color: #ddd;
}
</style>
</head>
   <body>
     <div>
        <dl>
	   <dt>term</dt>
	   <dd>description</dd>
	   <dt>term</dt>
	   <dd>description</dd>
	   <dt>term</dt>
	   <dd>description</dd>
       </dl>
     </div>
 </body>
</html>
```
