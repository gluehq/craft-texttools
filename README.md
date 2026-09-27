Removes redundant tags from text editor output, namely:

- Replaces consecutive `<br>` tags with just one
- Removes any `<br>` tags, white space and non-breaking spaces before the closing tag, so editors cannot pad the bottom of a paragraph with `<br>&nbsp;`
- Removes empty `p`, `h3`, `h4`, `h5`, `h6`, `a`, `li` and `blockquote` tags, including ones holding only that padding
- Inserts a non-breaking space `&nbsp;` between the last two words of any `p`, `h3`, `h4`, `h5`, `h6`, `a`, `li` and `blockquote` to fix any orphans, being single words on the last line



#### Usage

1. In the Craft control panel, you may have to uncheck the Clean up HTML and Purify HTML on the text editor field. These are security measures which you deactivate at your own risk.
2. In the templates, wrap the text editor ouput tag in an apply tag, like so:

```
{% apply texttools %}
    {{ entry.textField }}
{% endapply %}
```



#### Arguments

There is an argument for stripping `p` tags in addition to the above. Note that stripping tags only is catered for using the Twig filter `striptags` and declaring any tags you want to preserve, eg: `{{ entry.text|striptags('<a><strong><em>')|raw }}`.

```
{% apply texttools('strip_p_tags') %}
    {{ entry.textField }}
{% endapply %}
```