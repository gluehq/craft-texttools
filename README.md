Removes redundant tags from text editor output, namely:

- Replaces consecutive `<br>` tags with just one
- Removes any `<br>` tags before the closing tag
- Removes empty `<p>` tags
- Removes any white space before the closing tag



#### Usage

1. In the Craft control panel, you may have to uncheck the Clean up HTML and Purify HTML on the text editor field. These are security measures which you deactivate at your own risk.
2. In the templates, wrap the text editor ouput tag in a filter tag like so:

```
{% filter texttools %}
    {{ entry.textField }}
{% endfilter %}
```



#### Changes

Adding a non-breaking space between the last two words to fix typesetting orphans (ie a lone word on the last line) is no longer a default operation. This is because it can be a bad idea for certain combinations of short headlines, long words, large fonts, small containers or small viewports. It's better done with JavaScript to negotiate the responsive aspects, but you can still call this method by passing a specific argument:

```
{% filter texttools('fix_orphans') %}
	{{ entry.textField }}
{% endfilter %}
```

Similarly there was originally an argument for stripping `p` tags, but this was already catered for in Craft using the Twig filter `striptags` and declaring any tags you want to preserve, eg: `{{ entry.text|striptags('<a><strong><em>')|raw }}`. You can still call this method by passing this argument:

```
{% filter texttools('strip_p_tags') %}
	{{ entry.textField }}
{% endfilter %}
```