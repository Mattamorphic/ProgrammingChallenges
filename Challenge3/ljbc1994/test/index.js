import { assert } from 'chai'
import morsey from '../src'

describe('morsey converter tests', () => {
	
	const args = [
		{ value: 'HELLO WORLD', expect: '.... . .-.. .-.. ---  .-- --- .-. .-.. -..' },
		{ value: '.... . .-.. .-.. ---  .-- --- .-. .-.. -..', expect: 'HELLO WORLD' },
	]
	
	args.forEach((arg) => {
		
		it(`should return '${arg.expect}', given '${arg.value}'`, (done) => {
			
			assert(morsey(arg.value), arg.expect)
			
			done()
			
		})
		
	})
	
});