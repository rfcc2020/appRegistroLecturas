	/* Data SHA1: 7ee5e889604e9b8a889ce9dd13562eb140b7d465 */
	.file	"typemap.jm.inc"

	/* Mapping header */
	.section	.data.jm_typemap,"aw",@progbits
	.type	jm_typemap_header, @object
	.p2align	2
	.global	jm_typemap_header
jm_typemap_header:
	/* version */
	.long	1
	/* entry-count */
	.long	1286
	/* entry-length */
	.long	262
	/* value-offset */
	.long	117
	.size	jm_typemap_header, 16

	/* Mapping data */
	.type	jm_typemap, @object
	.global	jm_typemap
jm_typemap:
	.size	jm_typemap, 336933
	.include	"typemap.jm.inc"
