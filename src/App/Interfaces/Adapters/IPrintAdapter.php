<?php
namespace App\Interfaces\Adapters;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 15:22
 *
 * Interface IPrintAdapter
 * @package App\Interfaces\Adapters
 */
interface IPrintAdapter extends IShowAdapter
{

    /**
     * Adds a new page to the document. If a page is already present, the Footer() method is called first to output the footer (if enabled). Then the page is added, the current position set to the top-left corner according to the left and top margins (or top-right if in RTL mode), and Header() is called to display the header (if enabled).
     * The origin of the coordinate system is at the top-left corner (or top-right for RTL) and increasing ordinates go downwards.
     * @param string $orientation   page orientation. Possible values are (case insensitive):<ul><li>P or PORTRAIT (default)</li><li>L or LANDSCAPE</li></ul>
     * @param mixed $format         The format used for pages. It can be either: one of the string values specified at getPageSizeFromFormat() or an array of parameters specified at setPageFormat().
     * @param boolean $keepmargins  if true overwrites the default page margins with the current margins
     * @param boolean $tocpage      if true set the tocpage state to true (the added page will be used to display Table Of Content).
     *
     * @return $this
     */
    function addPage($orientation='', $format='', $keepmargins=false, $tocpage=false);

    /**
     * Reset pointer to the last document page.
     * @param $resetmargins (boolean) if true reset left, right, top margins and Y position.
     * @public
     * @since 2.0.000 (2008-01-04)
     * @see setPage(), getPage(), getNumPages()
     * @return $this
     */
    function lastPage($resetmargins=false);

    /**
     * 设置字体
     * @param string $family    Family font. It can be either a name defined by AddFont() or one of the standard Type1 families (case insensitive):<ul><li>times (Times-Roman)</li><li>timesb (Times-Bold)</li><li>timesi (Times-Italic)</li><li>timesbi (Times-BoldItalic)</li><li>helvetica (Helvetica)</li><li>helveticab (Helvetica-Bold)</li><li>helveticai (Helvetica-Oblique)</li><li>helveticabi (Helvetica-BoldOblique)</li><li>courier (Courier)</li><li>courierb (Courier-Bold)</li><li>courieri (Courier-Oblique)</li><li>courierbi (Courier-BoldOblique)</li><li>symbol (Symbol)</li><li>zapfdingbats (ZapfDingbats)</li></ul> It is also possible to pass an empty string. In that case, the current family is retained.
     * @param string $style     Font style. Possible values are (case insensitive):<ul><li>empty string: regular</li><li>B: bold</li><li>I: italic</li><li>U: underline</li><li>D: line through</li><li>O: overline</li></ul> or any combination. The default value is regular. Bold and italic styles do not apply to Symbol and ZapfDingbats basic fonts or other fonts when not defined.
     * @param float $size       Font size in points. The default value is the current size. If no size has been specified since the beginning of the document, the value taken is 12
     * @return static
     */
    function setFont($family, $style='', $size=null);

    /**
     * 设置字号
     * @param float $size   The font size in points.
     * @param boolean $out  if true output the font size command, otherwise only set the font properties.
     * @return $this
     */
    function setFontSize($size, $out=true);


    /**
     * Allows to preserve some HTML formatting (limited support).<br />
     * IMPORTANT: The HTML must be well formatted - try to clean-up it using an application like HTML-Tidy before submitting.
     * Supported tags are: a, b, blockquote, br, dd, del, div, dl, dt, em, font, h1, h2, h3, h4, h5, h6, hr, i, img, li, ol, p, pre, small, span, strong, sub, sup, table, tcpdf, td, th, thead, tr, tt, u, ul
     * NOTE: all the HTML attributes must be enclosed in double-quote.
     * @param string $html text to display
     * @param boolean $ln if true add a new line after text (default = true)
     * @param boolean $fill Indicates if the background must be painted (true) or transparent (false).
     * @param boolean $reseth if true reset the last cell height (default false).
     * @param boolean $cell if true add the current left (or right for RTL) padding to each Write (default false).
     * @param string $align Allows to center or align the text. Possible values are:<ul><li>L : left align</li><li>C : center</li><li>R : right align</li><li>'' : empty string : left for LTR or right for RTL</li></ul>
     *
     * @return $this
     */
    function writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='');
}