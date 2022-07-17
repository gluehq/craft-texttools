Removes redundant tags from text editor output, namely:

- Replaces consecutive `<br>` tags with just one
- Removes any `<br>` tags before the closing tag
- Removes empty `p`, `h3`, `h4`, `h5`, `h6`, `a`, `li` and `blockquote` tags
- Removes any white space before the closing tag
- Inserts a non-breaking space `&nbsp;` between the last two words of any `p`, `h3`, `h4`, `h5`, `h6`, `a`, `li` and `blockquote` to fix any orphans, being single words on the last line



#### Usage

1. In the Craft control panel, you may have to uncheck the Clean up HTML and Purify HTML on the text editor field. These are security measures which you deactivate at your own risk.
2. In the templates, wrap the text editor ouput tag in a filter tag like so:

```
{% filter texttools %}
    {{ entry.textField }}
{% endfilter %}
```



#### Changes

There was originally an argument for stripping `p` tags, but this was already catered for in Craft using the Twig filter `striptags` and declaring any tags you want to preserve, eg: `{{ entry.text|striptags('<a><strong><em>')|raw }}`. For legacy support reasons you can still call this method in the plugin by passing this argument:

```
{% filter texttools('strip_p_tags') %}
    {{ entry.textField }}
{% endfilter %}
```