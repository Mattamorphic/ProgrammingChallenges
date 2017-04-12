import { assert } from 'chai'
import failedSLA from '../src'

describe('Function for checking whether to pass or fail the ticket based on a SLA', () => {
	
	const args = [
		{
			shouldFail: false,
			created: '06-03-2017 08:00:00',
			end: '17-03-2017 10:00:00',
			range: 10,
			hoursInDay: 24,
			timeZone: {
				startZone: 'Australia/Sydney',
				endZone: 'Australia/Sydney'
			}
		},
		{
			shouldFail: true,
			created: '06-03-2017 08:00:00',
			end: '19-03-2017 10:00:00',
			range: 10,
			hoursInDay: 24,
			timeZone: {
				startZone: 'Australia/Sydney',
				endZone: 'Australia/Sydney'
			}
		}
	]
	
	args.forEach((arg) => {
		
		it(`should ${arg.shouldFail ? 'fail': 'pass'} the SLA if created at ${arg.created} and finished at ${arg.end} with a ${arg.range} day SLA`, (done) => {
			
			assert(failedSLA(arg), arg.shouldFail)
			
			done()
			
		})
		
	})
	
})