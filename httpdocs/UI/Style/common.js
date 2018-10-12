function printOrder(_url)
{/*   version 1.4.0.00 */
   printWindow = window.open(_url,
                       "printWindow","toolbar=0, location=0, status=1, resizable=1, menubar=1, "+
                       "scrollbars=1, width=750, height=540");
   printWindow.focus();
}
