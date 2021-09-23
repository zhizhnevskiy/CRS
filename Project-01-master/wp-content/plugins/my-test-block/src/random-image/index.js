//  Import CSS.
import './style.scss';
import './editor.scss';

const {__} = wp.i18n;
const {
	AlignmentToolbar,
	BlockControls,
	registerBlockType,
	query
} = wp.blocks;

function RandomImage({category}) {
	const src = 'https://placeimg.com/320/220/' + category;
	return <img src={src} alt={category}/>;
}

registerBlockType('cgb/block-random-image', {
	title: __('CRS Laboratories Block №02'),
	icon: 'code-standards',
	category: 'common',
	keywords: [
		__('random'),
		__('image')
	],
	attributes: {
		category: {
			type: 'string',
			default: 'nature'
		},
		categoryAlign: {
			type: 'string',
			default: ''
		}
	},

	edit: function (props) {

		const {attributes: {category, categoryAlign}, setAttributes, isSelected} = props;

		function setCategory(event) {
			const selected = event.target.querySelector('option:checked');
			setAttributes({category: selected.value});
			event.preventDefault();
		}

		return (
			<div className={props.className}>
				<RandomImage category={category}/>
				{isSelected && (
					<form onSubmit={setCategory} style={ {textAlign: categoryAlign} }>
						<select value={category} onChange={setCategory}>
							<option value="animals">Animals</option>
							<option value="arch">Architecture</option>
							<option value="nature">Nature</option>
							<option value="people">People</option>
							<option value="tech">Tech</option>
						</select>
					</form>
				)}
			</div>
		);
	}
,

save: function (props)
{
	const {attributes: {category}} = props;
	return (
		<div>
			<RandomImage category={category}/>
		</div>
	);
}
});
