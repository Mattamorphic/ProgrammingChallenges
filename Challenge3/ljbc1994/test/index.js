import { assert } from 'chai'
import morseConverter from '../src'

describe('morsey converter tests', () => {
	
	const args = [
		{ value: 'HELLO WORLD', expect: '.... . .-.. .-.. ---  .-- --- .-. .-.. -..' },
		{ value: '.... . .-.. .-.. ---  .-- --- .-. .-.. -..', expect: 'HELLO WORLD' },
	]
	
	args.forEach((arg) => {
		
		it(`should return '${arg.expect}', given '${arg.value}'`, () => {
			
			let morsey = morseConverter()
			
			assert.strictEqual(morsey(arg.value), arg.expect)
			
		})
		
	})
	
});